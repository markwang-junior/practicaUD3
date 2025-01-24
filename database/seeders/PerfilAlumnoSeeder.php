<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PerfilAlumno;

class PerfilAlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ejemplo de datos de prueba
        PerfilAlumno::create([
            'alumno_id' => 1, // Asegúrate de que este ID ya exista en la tabla "alumnos"
            'direccion' => 'Calle Falsa 123',
            'telefono' => '123456789',
        ]);

        PerfilAlumno::create([
            'alumno_id' => 2, // Asegúrate de que este ID ya exista en la tabla "alumnos"
            'direccion' => 'Avenida Principal 456',
            'telefono' => '987654321',
        ]);
    }
}
