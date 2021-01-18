<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre', 50);
            $table->text('descripcion')->nullable();
            $table->unsignedInteger('lugar_id');
            $table->dateTime('fechahora_ini');
            $table->dateTime('fechahora_fin');
            $table->integer('max_cupos');
            $table->integer('max_cupos_reserva');
            $table->unsignedTinyInteger('estado_id');
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->string('deleted_by', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lugar_id')->references('id')->on('lugares');
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
        Schema::table('eventos', function (Blueprint $table) {
            $table->dropForeign(['lugar_id']);
            $table->dropForeign(['estado_id']);
        });
        Schema::dropIfExists('eventos');
    }
}
