<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    use HasFactory;

    protected $table = 'usuarios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'apellidos',
        'direccion',
        'ciudad',
        'codigo_postal',
        'fecha_nacimiento',
        'telefono',
        'nombre_usuario',
        'email',
        'contraseña',
        'estado',
        'verificado',
        'foto_selfie',
        'foto_dni_anverso',
        'foto_dni_reverso',
    ];
}
