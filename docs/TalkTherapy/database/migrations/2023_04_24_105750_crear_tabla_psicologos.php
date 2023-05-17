<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPsicologos extends Migration
{
    public function up()
    {
        Schema::create('psicologos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('codigo_postal');
            $table->date('fecha_nacimiento');
            $table->string('email')->unique();
            $table->string('contraseña');
            $table->timestamp('fecha_registro')->useCurrent();
            $table->boolean('estado')->default(true);
            $table->boolean('verificado')->default(false);
            $table->string('num_colegiado')->unique();
            $table->decimal('precio_sesion', 8, 2);
            $table->string('foto_selfie')->nullable();
            $table->string('foto_dni_anverso')->nullable();
            $table->string('foto_dni_reverso')->nullable();
            $table->string('foto_diploma')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('psicologos');
    }
}
