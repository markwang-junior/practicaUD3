<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';
    protected $fillable = ['nombre', 'email'];

    // Relación N:M con Asignaturas
    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'matriculaciones', 'alumno_id', 'asignatura_id')
                    ->withPivot('fecha_matricula')
                    ->withTimestamps();
    }
}

