<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    /**
     * El nombre de la tabla asociada al modelo.
     * Laravel asume el plural, pero es una buena práctica especificarlo.
     *
     * @var string
     */
    protected $table = 'productos';

    /**
     * La llave primaria asociada a la tabla.
     * ¡Esto es crucial! Como no usaste el nombre por defecto 'id', 
     * debes indicarle a Laravel cuál es tu llave primaria.
     *
     * @var string
     */
    protected $primaryKey = 'id_producto';

    /**
     * Los atributos que son asignables en masa (Mass Assignment).
     * Esto te permite usar métodos como Producto::create([...]) de forma segura.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tipo_obra',
        'planes',
        'descripcion',
        'precio',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos (Casts).
     *
     * @var array<string, string>
     */
    protected $casts = [
        'precio' => 'decimal:2',
    ];
}