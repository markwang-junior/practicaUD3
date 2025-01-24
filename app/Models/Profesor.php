<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    protected $table = 'profesores';  
    protected $fillable = ['nombre', 'email'];

    // Relación 1:N con Asignaturas
    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class, 'profesor_id');
    }
}

