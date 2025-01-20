<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asignatura;

class AsignaturasSeeder extends Seeder
{
    public function run()
    {
        // Asumiendo los profesores con ID 1 y 2 existen por ProfesoresSeeder
        Asignatura::create(['nombre' => 'Matemáticas', 'profesor_id' => 1]);
        Asignatura::create(['nombre' => 'Lengua', 'profesor_id' => 2]);
    }
}

