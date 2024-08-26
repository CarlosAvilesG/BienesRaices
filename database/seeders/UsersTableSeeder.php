<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'curp' => 'AIGC060683HDFVRS01', // Único
                'email' => 'ing.josecarlos@gmail.com',
                'foto_url' => 'https://via.placeholder.com/150',
                'paterno' => 'Garcia',
                'materno' => 'Garcia',
                'nombre' => 'Jose Carlos',
                'password' => Hash::make('password'),
                'paterno' => 'Aviles',
                'rol' => 'admin',
                'telefono' => '5555555555',
            ],
            [
                'curp' => 'BMXG720213HDFTRS08', // Único
                'email' => 'garza@gmail.com',
                'foto_url' => 'https://via.placeholder.com/151',
                'paterno' => 'lopez',
                'materno' => 'Garcia',
                'nombre' => 'Sandra',
                'password' => Hash::make('password'),
                'paterno' => 'Garza',
                'rol' => 'admin',
                'telefono' => '5555555555',
            ],
            [
                'curp' => 'ZXYG850724HDFTRF01', // Único
                'email' => 'goku@gmail.com',
                'foto_url' => 'https://via.placeholder.com/153',
                'paterno' => 'vegeta',
                'materno' => 'Sayayin',
                'nombre' => 'Daniel',
                'password' => Hash::make('password'),
                'paterno' => 'Goku',
                'rol' => 'admin',
                'telefono' => '5555555555',
            ],
        ]);
    }
}
