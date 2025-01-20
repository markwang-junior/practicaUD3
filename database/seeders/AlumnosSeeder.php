<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumno;

class AlumnosSeeder extends Seeder
{
    public function run()
    {
        Alumno::create(['nombre' => 'Carlos Ruiz', 'email' => 'cruiz@example.com']);
        Alumno::create(['nombre' => 'Ana López', 'email' => 'alopez@example.com']);
    }
}

