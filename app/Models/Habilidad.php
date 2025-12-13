<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Habilidad extends Model
{
    protected $table = 'habilidades';

    protected $fillable = [
        'nombre',
        'slug',
        'categoria_id',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean'
    ];

    /**
     * Categoría a la que pertenece
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Trabajos que requieren esta habilidad
     */
    public function trabajos(): BelongsToMany
    {
        return $this->belongsToMany(Trabajo::class, 'trabajo_habilidad');
    }
}
