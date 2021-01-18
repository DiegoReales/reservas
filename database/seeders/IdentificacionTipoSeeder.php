<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdentificacionTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('identificacion_tipos')->insert([
            ['abreviatura' => 'CC', 'nombre' => 'Cedula de Ciudadania'],
            ['abreviatura' => 'TI', 'nombre' => 'Tarjeta de Identidad'],
            ['abreviatura' => 'RC', 'nombre' => 'Registro Civil'],
            ['abreviatura' => 'PP', 'nombre' => 'Pasaporte'],
        ]);
    }
}
