<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropuestaActividad extends Model
{
    protected $table = 'propuesta_actividades';
    
    protected $fillable = [
        'tipo_propuesta', 'actividad_id', 'area_base', 'multiplicador_m2'
    ];
    
    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }
}