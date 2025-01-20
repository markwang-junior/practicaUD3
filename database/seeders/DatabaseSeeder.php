<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
// Si lo deseas, puedes importar explícitamente tus seeders, pero si están 
// en el mismo namespace Database\Seeders, no es obligatorio.
// use Database\Seeders\ProfesoresSeeder;
// use Database\Seeders\AlumnosSeeder;
// use Database\Seeders\AsignaturasSeeder;
// use Database\Seeders\MatriculacionesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Si quieres mantener el User por defecto:
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Llama a todos los seeders que has creado
        $this->call([
            ProfesoresSeeder::class,
            AlumnosSeeder::class,
            AsignaturasSeeder::class,
            MatriculacionesSeeder::class,
        ]);
    }
}
