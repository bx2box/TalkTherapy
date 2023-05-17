<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaUsuarios extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // utiliza la columna "id" como clave primaria
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('codigo_postal');
            $table->date('fecha_nacimiento');
            $table->string('telefono');
            $table->string('nombre_usuario')->unique();
            $table->string('email')->unique();
            $table->string('contraseña');
            $table->boolean('estado')->default(true);
            $table->boolean('verificado')->default(false);
            $table->string('foto_selfie')->nullable();
            $table->string('foto_dni_anverso')->nullable();
            $table->string('foto_dni_reverso')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
