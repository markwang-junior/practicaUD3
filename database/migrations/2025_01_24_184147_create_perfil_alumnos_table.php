<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('perfil_alumnos', function (Blueprint $table) {
        // Caso 1: Usar alumno_id como PK y FK a la vez
        // El PK es alumno_id (NO auto-increment)
        $table->unsignedBigInteger('alumno_id')->primary();
        
        // Definimos la relación con la tabla alumnos
        $table->foreign('alumno_id')
              ->references('id')     // si tu PK en alumnos es 'id'
              ->on('alumnos')       // nombre de la tabla
              ->onDelete('cascade');
        
        // Campos extra de perfil
        $table->string('direccion')->nullable();
        $table->string('telefono')->nullable();
        
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('perfil_alumnos');
}

};
