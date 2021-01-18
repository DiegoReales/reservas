<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedTinyInteger('identificacion_tipo_id');
            $table->string('identificacion_numero', 14);
            $table->string('nombres', 60);
            $table->string('apellidos', 60);
            $table->date('fecha_nacimiento');
            $table->string('correo_electronico', 100);
            $table->string('telefono', 12);
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();

            $table->foreign('identificacion_tipo_id')->references('id')->on('identificacion_tipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->dropForeign(['identificacion_tipo_id']);
        });
        Schema::dropIfExists('personas');
    }
}
