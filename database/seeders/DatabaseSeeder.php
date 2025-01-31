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
            PerfilAlumnoSeeder::class,
        ]);
    }
}
