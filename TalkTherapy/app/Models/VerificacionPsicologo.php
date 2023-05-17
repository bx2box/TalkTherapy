<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificacionPsicologo extends Model
{
    use HasFactory;

    protected $table = 'verificacionPsicologos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'tipo_verificacion',
        'estado',
        'fecha_verificacion',
    ];

    public function psicologo()
    {
        return $this->belongsTo(Psicologo::class, 'id');
    }
}
