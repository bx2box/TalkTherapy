<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_cita';
    public $incrementing = false;

    protected $fillable = [
        'id_cita',
        'id_usuario',
        'id_psicologo',
        'fecha_cita',
        'duracion_cita',
        'estado'
    ];

    protected $dates = [
        'fecha_cita'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function psicologo()
{
    return $this->belongsTo(Psicologo::class, 'id_psicologo');
}

}
