<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profesor;

class ProfesoresSeeder extends Seeder
{
    public function run()
    {
        Profesor::create(['nombre' => 'Juan Pérez', 'email' => 'jperez@example.com']);
        Profesor::create(['nombre' => 'María García', 'email' => 'mgarcia@example.com']);
    }
}

