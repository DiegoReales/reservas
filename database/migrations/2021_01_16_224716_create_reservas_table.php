<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('evento_id');
            $table->string('codigo', 10);
            $table->integer('cantidad_cupos');
            $table->unsignedTinyInteger('estado_id');
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->string('deleted_by', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('evento_id')->references('id')->on('eventos');
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
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropForeign(['evento_id']);
            $table->dropForeign(['estado_id']);
        });
        Schema::dropIfExists('reservas');
    }
}
