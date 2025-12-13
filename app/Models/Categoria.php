<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'icono',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean'
    ];

    /**
     * Obtener trabajos de esta categoría
     */
    public function trabajos(): HasMany
    {
        return $this->hasMany(Trabajo::class);
    }

    /**
     * Obtener habilidades de esta categoría
     */
    public function habilidades(): HasMany
    {
        return $this->hasMany(Habilidad::class);
    }
}
