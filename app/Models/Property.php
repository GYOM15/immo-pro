<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'surface',
        'rooms',
        'bedrooms',
        'floor',
        'price',
        'city',
        'address',
        'postal_code',
        'sold',
    ];
    
    /**
     * Nous avons une relation many to many
     *
     * @return BelongsToMany
     */
    public function options() : BelongsToMany{
        return $this->belongsToMany(Option::class);
    }

         
    /**
     * getSlug génère automatiquement un slug
     *
     * @return string
     */
    public function getSlug() : string{
        return Str::slug($this->title);
    }
     
    /**
     * Relation entre les images et le bien en question 
     * relation one to many 
     *
     * @return HasMany
     */
    public function pictures(): HasMany {
        return $this ->hasMany(Picture::class);
    }

    /**
     * attachFiles
     * Cette méthode attache des fichiers à un modèle et les stocke sur le système de fichiers.
     *
     * @param  UploadedFile[] $files - Un tableau d'objets UploadedFile représentant les fichiers à attacher.
     * @return void
     */
    public function attachFiles(array $files){
        $pictures = [];
        // Parcours de chaque fichier dans le tableau $files
        foreach($files as $file){
            // Vérifie si le fichier a une erreur par getError qui est la methode de UploadedFile, si oui, passe à l'itération suivante
            if($file->getError()) continue;
            /**  Stocke le fichier sur le système de fichiers et récupère son chemin relatif
            *  Elle prend deux arguments : le premier est le chemin de stockage relatif au répertoire de stockage configuré dans l'application 
            *  (dans ce cas, le dossier 'public/properties/' suivi de l'ID du modèle), et le deuxième argument est le nom du disque de stockage à utiliser (dans ce cas, 'public')
            */
            $filename = $file->store('properties/' . $this->id, 'public');
            // Crée un nouvel enregistrement dans la table associée au modèle pour le fichier
            $pictures[]=[
                'filename' => $filename
            ];
        }
        if(count($pictures)>0){
            if(count($pictures)>0){
                /** Si des fichiers ont été traités avec succès,
                * la méthode createMany() crée plusieurs enregistrements en une seule opération dans la base de données.
                * Elle prend un tableau multidimensionnel où chaque sous-tableau représente les données d'un enregistrement à créer.
                * Dans ce cas, $pictures est ce tableau multidimensionnel,
                * où chaque sous-tableau contient le nom de fichier correspondant à un fichier traité avec succès.
                * La méthode crée une entrée dans la base de données pour chaque sous-tableau,
                *ce qui revient à créer un enregistrement pour chacun des fichiers.
                */ 
                $this->pictures()->createMany($pictures);
            }
        }
    }

    public function getPicture() : ?Picture{
        return $this->pictures[0] ?? null;
    }
    
    /**
     * scopeAvailable
     *
     * @param  mixed $builder
     * @return Builder
     */
    public function scopeAvailable(Builder $builder, bool $available = true) : Builder {
        return $builder->where('sold', !$available);
    }
    
    /**
     * scopeRecent
     *
     * @param  mixed $builder
     * @return Builder
     */
    public function scopeRecent(Builder $builder) : Builder {
        return $builder->orderBy('created_at', 'desc');
    }
}
