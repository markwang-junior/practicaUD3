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
    Schema::create('asignaturas', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        // Relación con profesor
        $table->unsignedBigInteger('profesor_id');
        $table->foreign('profesor_id')->references('id')->on('profesores')->onDelete('cascade');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('asignaturas');
}

};
