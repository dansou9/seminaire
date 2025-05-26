<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SecretaryUserSeeder extends Seeder
{
    public function run()
    {
        // On cherche l'ID du rôle super_admin via la colonne `nom`
        $roleId = DB::table('roles')->where('nom', 'secretaire')->value('id');

        if (!$roleId) {
            $roleId = DB::table('roles')->insertGetId([
                'nom' => 'secretaire',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        // Création ou mise à jour de l'utilisateur secrétaire
        User::updateOrCreate(
            ['email' => 'godwill.agbikodo@gmail.com'],
            [
                'name' => 'Secrétaire',
                'email' => 'godwill.agbikodo@gmail.com',
                'password' => Hash::make('motdepasse'),
                'status' => 'actif',
                'role_id' => $roleId,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
