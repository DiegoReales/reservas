<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_personas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedInteger('reserva_id');
            $table->unsignedInteger('persona_id');
            $table->boolean('titular');
            $table->unsignedTinyInteger('estado_id');

            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('estado_id')->references('id')->on('evento_estados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reserva_personas', function (Blueprint $table) {
            $table->dropForeign(['reserva_id']);
            $table->dropForeign(['persona_id']);
            $table->dropForeign(['estado_id']);
        });
        Schema::dropIfExists('reserva_personas');
    }
}
