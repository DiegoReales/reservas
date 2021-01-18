<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservaEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reserva_estados')->insert([
            ['nombre' => 'Pendiente'],
            ['nombre' => 'Utilizada'],
            ['nombre' => 'Uso Parcial'],
            ['nombre' => 'Cancelada'],
            ['nombre' => 'Vencida'],
        ]);
    }
}
