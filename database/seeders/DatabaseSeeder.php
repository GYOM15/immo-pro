<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Option;
use App\Models\Property;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        // Pour creer un utilisateur non vérifié, on utilise la méthode
        // unverifed dans notre factory de la sorte
        User::factory()->unverified()->create();

        // Possibilité de lui passer les paramètres, seulement 
        // que cela écrasera les valeurs déjà défini dans le factory
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
         
        //Création de 10 options
        $options = Option::factory(10)->create();
        
        // Création de 50 biens 
        Property::factory(50)->hasAttached($options->random(3))-> create();

       
    }
}
