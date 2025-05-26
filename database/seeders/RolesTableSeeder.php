<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['nom' => 'Secretaire', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Enseignant', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Etudiant', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
