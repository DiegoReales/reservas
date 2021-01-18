<?php

namespace App\Models;

use App\Traits\UserSave;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Lugar
 *
 * @property int $id
 * @property string $nombre
 * @property string $direccion
 * @property string $telefono
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Evento[] $eventos
 * @property-read int|null $eventos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Lugar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lugar newQuery()
 * @method static \Illuminate\Database\Query\Builder|Lugar onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Lugar query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lugar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lugar whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lugar whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lugar whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lugar whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lugar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lugar whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lugar whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lugar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lugar whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Lugar withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Lugar withoutTrashed()
 * @mixin \Eloquent
 */
class Lugar extends Model
{
    use HasFactory, SoftDeletes, UserSave;

    protected $table = 'lugares';
    protected $fillable = ['nombre', 'direccion', 'telefono'];

    public function eventos() {
        return $this->hasMany('App\Models\Evento', 'estado_id');
    }
}
