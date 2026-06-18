<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CotizacionActividad extends Model
{
    protected $table = 'cotizacion_actividades';

    protected $fillable = [
        'cotizacion_id',
        'tipo_plan',
        'categoria',
        'descripcion',
        'unidad',
        'cantidad',
        'valor_unitario',
        'vr_total',
        'es_adicional',
    ];

    protected $casts = [
        'cantidad'       => 'decimal:2',
        'valor_unitario' => 'decimal:2',
        'vr_total'       => 'decimal:2',
        'es_adicional'   => 'boolean',
    ];

    public function cotizacion(): BelongsTo
    {
        return $this->belongsTo(Cotizacion::class);
    }
}
