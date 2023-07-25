<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_temporada');
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_inscripcion');
            $table->string('comprobante');
            $table->string('fecha');
            $table->string('detalle');

            $table->foreign('id_temporada')->references('id')->on('temporadas');
            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->foreign('id_persona')->references('id')->on('personas');
            $table->foreign('id_inscripcion')->references('id')->on('inscripciones');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
