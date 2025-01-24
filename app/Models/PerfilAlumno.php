<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilAlumno extends Model
{
    use HasFactory;

    protected $table = 'perfil_alumnos';
    public $incrementing = false; // si usas la PK compartida

    protected $primaryKey = 'alumno_id'; // si usas la PK alumno_id

    protected $fillable = [
        'alumno_id', 
        'direccion', 
        'telefono'
    ];

    // Relación inversa 1..1 con Alumno
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }
}
