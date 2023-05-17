<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaVerificacionPsicologos extends Migration
{
    public function up()
    {
        Schema::create('verificacionPsicologos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_psicologo');
            $table->enum('tipo_verificacion', ['identidad', 'colegiacion']);
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado']);
            $table->timestamp('fecha_verificacion')->useCurrent();
            $table->timestamps();
            $table->foreign('id_psicologo')->references('id')->on('psicologos')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('verificacionPsicologos');
    }
};
