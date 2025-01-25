<?php

use App\Models\Property;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            /**  Le constrained permet de générer une érreur en cas de suppression du bien, car il faut d'abord supprimer les images avant les biens
            *   Cela est important pour nettoyer les images egalement. On ne fera pas non plus de delete en casscade
            *   Cela nous permet aussi de ne pas faire une suppression qu'on ne contrôle pas*/
            $table->foreignIdFor(Property::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pictures');
    }
};
