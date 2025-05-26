<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tu peux ajouter d'autres seeders ici si besoin, par exemple :
        $this->call([RolesTableSeeder::class]);

        // Appel du seeder pour créer automatiquement le compte de la secrétaire
        $this->call(SecretaryUserSeeder::class);
    }
}
