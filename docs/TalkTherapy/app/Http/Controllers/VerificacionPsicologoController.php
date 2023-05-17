<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificacionPsicologo extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'verificacionPsicologos';

    // Nombre de la clave primaria en la tabla
    protected $primaryKey = 'id';

    // Los campos que se pueden asignar masivamente
    protected $fillable = [
        'id',
        'tipo_verificacion',
        'estado',
        'fecha_verificacion'
    ];

    // Relación: una verificación pertenece a un psicologo
    public function psicologo()
    {
        return $this->belongsTo(Psicologo::class, 'id');
    }
}
