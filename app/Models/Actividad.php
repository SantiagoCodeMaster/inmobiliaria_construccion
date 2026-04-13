<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Actividad extends Model
{
    protected $table = 'actividades';

    protected $fillable = [
        'nombre',
        'descripcion',
        'unidad',
        'valor_unitario',
        'campo_usuario',
        'link',
    ];

    protected $casts = [
        'valor_unitario' => 'decimal:2',
    ];

    public function propuestaActividades(): HasMany
    {
        return $this->hasMany(PropuestaActividad::class, 'actividad_id');
    }
}
