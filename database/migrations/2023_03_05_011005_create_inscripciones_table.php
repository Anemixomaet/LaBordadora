<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_temporada');
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_persona');
            $table->string('observacion');
            
            $table->foreign('id_temporada')->references('id')->on('temporadas');
            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->foreign('id_persona')->references('id')->on('personas');
            
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
        Schema::dropIfExists('inscripciones');
    }
}
