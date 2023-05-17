<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaVerificacionUsuarios extends Migration
{
    public function up()
    {
        Schema::create('verificacionUsuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->enum('tipo_verificacion', ['identidad']);
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado']);
            $table->timestamp('fecha_verificacion')->useCurrent();
            $table->timestamps();
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('verificacionUsuarios');
    }
};
