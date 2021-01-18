<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Persona
 *
 * @property int $id
 * @property int $identificacion_tipo_id
 * @property string $identificacion_numero
 * @property string $nombres
 * @property string $apellidos
 * @property string $fecha_nacimiento
 * @property string $correo_electronico
 * @property string $telefono
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $identificacion
 * @property-read mixed $nombre_completo
 * @property-read \App\Models\IdentificacionTipo $identificaciontipo
 * @method static \Illuminate\Database\Eloquent\Builder|Persona newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Persona newQuery()
 * @method static \Illuminate\Database\Query\Builder|Persona onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Persona query()
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereApellidos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereCorreoElectronico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereFechaNacimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereIdentificacionNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereIdentificacionTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereNombres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Persona withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Persona withoutTrashed()
 * @mixin \Eloquent
 */
class Persona extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'personas';
    protected $fillable = ['identificacion_tipo_id', 'identificacion_numero', 'nombres', 'apellidos',
        'fecha_nacimiento', 'correo_electronico', 'telefono'];

    public function identificaciontipo() {
        return $this->belongsTo('App\Models\IdentificacionTipo', 'identificacion_tipo_id');
    }

    public function getNombreCompletoAttribute() {
        return "{$this->nombres} {$this->apellidos}";
    }

    public function getIdentificacionAttribute() {
        return "{$this->identificaciontipo->nombre} {$this->identificacion_numero}";
    }
}
