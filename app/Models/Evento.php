<?php

namespace App\Models;

use Encore\Admin\Facades\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Evento
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property int $lugar_id
 * @property string $fecha
 * @property string $hora
 * @property int $min_cupos
 * @property int $max_cupos
 * @property int $estado_id
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\EventoEstado $estado
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reserva[] $reservas
 * @property-read int|null $reservas_count
 * @method static \Illuminate\Database\Eloquent\Builder|Evento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evento newQuery()
 * @method static \Illuminate\Database\Query\Builder|Evento onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Evento query()
 * @method static \Illuminate\Database\Eloquent\Builder|Evento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evento whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evento whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evento whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evento whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evento whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evento whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evento whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evento whereLugarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evento whereMaxCupos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evento whereMinCupos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evento whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evento whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evento whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Evento withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Evento withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\Lugar $lugar
 */
class Evento extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'eventos';
    protected $fillable = ['nombre', 'descripcion', 'lugar_id', 'fechahora',
        'max_cupos', 'max_cupos_reserva', 'estado_id'];

    const FIRST_STATE = 1;

    public function estado() {
        return $this->belongsTo('App\Models\EventoEstado', 'estado_id');
    }

    public function lugar() {
        return $this->belongsTo('App\Models\Lugar', 'lugar_id');
    }

    public function reservas() {
        return $this->hasMany('App\Models\Reserva', 'evento_id');
    }

    public function getFechahoraRangoAttribute() {
        return "{$this->fechahora_ini} - {$this->fechahora_fin}";
    }

    public function getCuposReservados() {
        $count = 0;
        foreach($this->reservas as $reserva) {
            $count += $reserva->reservapersonas->count();
        }
        return $count;
    }

    public function save(array $options = []) {
        $username = Admin::user()->username ?? null;
        if (!$this->id)  {
            $this->created_by = $username;
            if (!$this->estado_id) $this->estado_id = self::FIRST_STATE;
        }
        $this->updated_by = $username;
        return parent::save($options);
    }
}
