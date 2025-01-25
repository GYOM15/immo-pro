<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use League\Glide\Urls\UrlBuilderFactory;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
    ];
    
    public static function booted(){
        static::deleting(function(Picture $picture){
            Storage::disk('public')->delete($picture->filename);
        });
    }

    /**
     * getImageUrl
     * This function return the filename in order to display it on administration page
     * @return 
     */
    public function getImageUrl(?int $width = null, ?int $height = null) : String{
        if($width===0){
            return Storage::disk('public')->url($this->filename);
        }
        // Use to create an url for image when width or parameters are given
        $urlBuilder =UrlBuilderFactory::create('/images/', config('glide.key'));
        return $urlBuilder->getUrl($this->filename, [
            'w' => $width,
            'h' => $height,
            'fit' => 'crop'
        ]);
    }
}
