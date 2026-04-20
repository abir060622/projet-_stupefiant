<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création du Responsable Pharmacie
        User::factory()->create([
            'name' => 'Admin Pharmacie',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'responsable',
        ]);

        // Création d'une Infirmière
        User::factory()->create([
            'name' => 'Sara Infirmière',
            'email' => 'sara@test.com',
            'password' => bcrypt('password'),
            'role' => 'infirmier',
        ]);
    }
}