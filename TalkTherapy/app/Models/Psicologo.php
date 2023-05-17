<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Psicologo extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    public function getAuthIdentifierName()
    {
        return 'id';
    }
    use HasFactory;

    protected $table = 'psicologos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'direccion',
        'ciudad',
        'codigo_postal',
        'fecha_nacimiento',
        'email',
        'contraseña',
        'estado',
        'verificado',
        'num_colegiado',
        'precio_sesion',
        'foto_selfie',
        'foto_dni_anverso',
        'foto_dni_reverso',
        'foto_diploma'
    ];
}
