<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReservaEstado
 *
 * @property int $id
 * @property int $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reserva[] $reservas
 * @property-read int|null $reservas_count
 * @method static \Illuminate\Database\Eloquent\Builder|ReservaEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservaEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservaEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservaEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservaEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservaEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservaEstado whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReservaEstado extends Model
{
    use HasFactory;

    protected $table = 'reserva_estados';
    protected $fillable = ['nombre'];

    public function reservas() {
        return $this->hasMany('App\Models\Reserva', 'estado_id');
    }
}
