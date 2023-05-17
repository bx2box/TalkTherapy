<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $primaryKey = 'id_pago';

    protected $fillable = [
        'id_usuario',
        'id_psicologo',
        'id_cita',
        'cantidad',
        'fecha_pago',
        'estado',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function psicologo()
    {
        return $this->belongsTo(Psicologo::class, 'id_psicologo');
    }

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita');
    }
}
