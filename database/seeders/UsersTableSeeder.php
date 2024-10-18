<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Add this line to import the Str class

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Juan Perez',
                'paterno' => 'Perez',
                'materno' => 'Gomez',
                'nombre' => 'Juan',
                'email' => 'juan.perez@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'), // Puedes usar Hash::make() para encriptar la contraseña
                'remember_token' => Str::random(10),
                'current_team_id' => null,
                'profile_photo_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maria Rodriguez',
                'paterno' => 'Rodriguez',
                'materno' => 'Lopez',
                'nombre' => 'Maria',
                'email' => 'maria.rodriguez@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'current_team_id' => null,
                'profile_photo_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pedro Martinez',
                'paterno' => 'Martinez',
                'materno' => 'Hernandez',
                'nombre' => 'Pedro',
                'email' => 'Pedro.Martinez@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'current_team_id' => null,
                'profile_photo_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // crea dos usuarios más

            [
                'name' => 'Luisa Sanchez',
                'paterno' => 'Sanchez',
                'materno' => 'Garcia',
                'nombre' => 'Luisa',
                'email' => 'luis@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'current_team_id' => null,
                'profile_photo_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carlos Lopez',
                'paterno' => 'Lopez',
                'materno' => 'Garcia',
                'nombre' => 'Carlos',
                'email' => 'carlos.lopex@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'current_team_id' => null,
                'profile_photo_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],



        ]);
    }
}
