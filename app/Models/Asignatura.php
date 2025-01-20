<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $table = 'asignaturas';
    protected $fillable = ['nombre', 'profesor_id'];

    // Relación N:1 con Profesor
    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }

    // Relación N:M con Alumnos
    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'matriculaciones', 'asignatura_id', 'alumno_id')
                    ->withPivot('fecha_matricula')
                    ->withTimestamps();
    }
}

