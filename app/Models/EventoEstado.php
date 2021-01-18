<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EventoEstado
 *
 * @property int $id
 * @property int $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Evento[] $eventos
 * @property-read int|null $eventos_count
 * @method static \Illuminate\Database\Eloquent\Builder|EventoEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventoEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventoEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|EventoEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventoEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventoEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventoEstado whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EventoEstado extends Model
{
    use HasFactory;

    protected $table = 'evento_estados';
    protected $fillable = ['nombre'];

    public function eventos() {
        return $this->hasMany('App\Models\Evento', 'estado_id');
    }

}
