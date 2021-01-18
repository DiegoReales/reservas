<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventoEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('evento_estados')->insert([
            ['nombre' => 'Abierto'],
            ['nombre' => 'Cerrado'],
            ['nombre' => 'Cancelado'],
        ]);
    }
}
