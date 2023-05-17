<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaResenasPsicologos extends Migration
{
    public function up()
    {
        Schema::create('resenasPsicologos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_psicologo');
            $table->integer('estrellas');
            $table->timestamps();
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_psicologo')->references('id')->on('psicologos')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('resenasPsicologos');
    }
}
