<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\IdentificacionTipo
 *
 * @property int $id
 * @property int $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Persona[] $personas
 * @property-read int|null $personas_count
 * @method static \Illuminate\Database\Eloquent\Builder|IdentificacionTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IdentificacionTipo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IdentificacionTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|IdentificacionTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentificacionTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentificacionTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentificacionTipo whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $abreviatura
 * @method static \Illuminate\Database\Eloquent\Builder|IdentificacionTipo whereAbreviatura($value)
 */
class IdentificacionTipo extends Model
{
    use HasFactory;

    protected $table = 'identificacion_tipos';
    protected $fillable = ['nombre', 'abreviatura'];

    public function personas() {
        return $this->hasMany('App\Models\Persona', 'identificacion_tipo_id');
    }
}
