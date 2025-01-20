<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumno;
use App\Models\Asignatura;

class MatriculacionesSeeder extends Seeder
{
    public function run()
    {
        // Alumno ID 1 se matricula en Asignatura ID 1
        $alumno1 = Alumno::find(1);
        $alumno1->asignaturas()->attach(1, ['fecha_matricula' => now()]);

        // Alumno ID 2 se matricula en Asignatura ID 2
        $alumno2 = Alumno::find(2);
        $alumno2->asignaturas()->attach(2, ['fecha_matricula' => now()]);
    }
}

