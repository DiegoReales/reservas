<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Reserva
 *
 * @property-read \App\Models\ReservaEstado $estado
 * @property-read \App\Models\Evento $evento
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Persona[] $personas
 * @property-read int|null $personas_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ReservaPersona[] $reservapersonas
 * @property-read int|null $reservapersonas_count
 * @method static \Illuminate\Database\Eloquent\Builder|Reserva newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reserva newQuery()
 * @method static \Illuminate\Database\Query\Builder|Reserva onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reserva query()
 * @method static \Illuminate\Database\Query\Builder|Reserva withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Reserva withoutTrashed()
 * @mixin \Eloquent
 */
class Reserva extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reserva';
    protected $fillable = ['evento_id', 'codigo', 'cantidad_cupos', 'estado_id'];

    public function estado() {
        return $this->belongsTo('App\Models\ReservaEstado', 'estado_id');
    }

    public function evento() {
        return $this->belongsTo('App\Models\Evento', 'evento_id');
    }

    public function reservapersonas() {
        return $this->hasMany('App\Models\ReservaPersona', 'reserva_id');
    }

    public function personas() {
        return $this->belongsToMany('App\Models\Persona', 'reserva_personas', 'reserva_id', 'persona_id')
            ->withPivot(['estado_id', 'titular']);
    }

    public function getCuposReservados() {
        return $this->reservapersonas->count();;
    }
}
