<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cotizaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'tipo_obra',
        'area_privada',
        'num_puertas',
        'num_closets',
        'num_banos',
        'tiene_mueble_alto_cocina',
        'tiene_barra_auxiliar',
        'nombre_proyecto',
        'fecha_entrega',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'area_privada'             => 'decimal:2',
        'num_puertas'              => 'integer',
        'num_closets'              => 'integer',
        'num_banos'                => 'integer',
        'tiene_mueble_alto_cocina' => 'boolean',
        'tiene_barra_auxiliar'     => 'boolean',
        'fecha_entrega'            => 'date',
        'created_at'               => 'datetime',
        'updated_at'               => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<int, string>
     */
    protected $dates = [
        'fecha_entrega',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the full name of the client.
     */
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombre} {$this->apellido}";
    }

    /**
     * Scope a query to search by name or email.
     */
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('nombre', 'like', "%{$searchTerm}%")
                     ->orWhere('apellido', 'like', "%{$searchTerm}%")
                     ->orWhere('email', 'like', "%{$searchTerm}%")
                     ->orWhere('nombre_proyecto', 'like', "%{$searchTerm}%");
    }

    /**
     * Scope a query to filter by tipo_obra.
     */
    public function scopeOfTipoObra($query, $tipoObra)
    {
        return $query->where('tipo_obra', $tipoObra);
    }

    /**
     * Scope a query to filter by date range.
     */
    public function scopeEntreFechas($query, $fechaInicio, $fechaFin)
    {
        return $query->whereBetween('fecha_entrega', [$fechaInicio, $fechaFin]);
    }

    /**
     * Scope a query to get recent cotizaciones.
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Format the area_privada attribute.
     */
    public function getAreaPrivadaFormateadaAttribute(): string
    {
        return number_format($this->area_privada, 2, ',', '.') . ' m²';
    }

    /**
     * Format the fecha_entrega attribute.
     */
    public function getFechaEntregaFormateadaAttribute(): string
    {
        return $this->fecha_entrega ? $this->fecha_entrega->format('d/m/Y') : 'No definida';
    }

    /**
     * Check if the cotizacion has all required fields.
     */
    public function estaCompleta(): bool
    {
        return !empty($this->nombre) && 
               !empty($this->apellido) && 
               !empty($this->email) && 
               !empty($this->telefono);
    }
}