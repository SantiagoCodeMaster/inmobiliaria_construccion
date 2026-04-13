<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropuestaActividad extends Model
{
    protected $table = 'propuesta_actividades';

    protected $fillable = [
        'tipo_propuesta',
        'actividad_id',
        'area_base',
        'multiplicador_m2',
    ];

    protected $casts = [
        'area_base'       => 'decimal:2',
        'multiplicador_m2' => 'decimal:4',
    ];

    public function actividad(): BelongsTo
    {
        return $this->belongsTo(Actividad::class, 'actividad_id');
    }
}
