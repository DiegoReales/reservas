<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReservaPersona
 *
 * @property int $id
 * @property int $reserva_id
 * @property int $persona_id
 * @property bool $titular
 * @property int $estado_id
 * @property-read \App\Models\ReservaEstado $estado
 * @property-read \App\Models\Persona $persona
 * @property-read \App\Models\Reserva $reserva
 * @method static \Illuminate\Database\Eloquent\Builder|ReservaPersona newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservaPersona newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservaPersona query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservaPersona whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservaPersona whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservaPersona wherePersonaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservaPersona whereReservaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservaPersona whereTitular($value)
 * @mixin \Eloquent
 */
class ReservaPersona extends Model
{
    use HasFactory;

    protected $table = 'reserva_personas';
    protected $fillable = ['reserva_id', 'persona_id', 'titular', 'estado_id'];
    protected $casts = ['titular' => 'bool'];
    public $timestamps = false;

    public function reserva() {
        return $this->belongsTo('App\Models\Reserva', 'reserva_id');
    }

    public function estado() {
        return $this->belongsTo('App\Models\ReservaEstado', 'estado_id');
    }

    public function persona() {
        return $this->belongsTo('App\Models\Persona', 'persona_id');
    }


}
