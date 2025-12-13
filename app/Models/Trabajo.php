<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trabajo extends Model
{
    use SoftDeletes;

    protected $table = 'trabajos';

    protected $fillable = [
        'cliente_id',
        'freelancer_id',
        'categoria_id',
        'titulo',
        'descripcion',
        'presupuesto_min',
        'presupuesto_max',
        'tipo_presupuesto',
        'duracion_estimada',
        'modalidad',
        'estado',
        'nivel_experiencia',
        'fecha_inicio',
        'fecha_fin',
        'fecha_limite_propuestas',
        'publicado_en',
        'asignado_en',
        'completado_en',
        'archivos_adjuntos',
        'num_propuestas'
    ];

    protected $casts = [
        'presupuesto_min' => 'decimal:2',
        'presupuesto_max' => 'decimal:2',
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'fecha_limite_propuestas' => 'datetime',
        'publicado_en' => 'datetime',
        'asignado_en' => 'datetime',
        'completado_en' => 'datetime',
        'archivos_adjuntos' => 'array',
        'num_propuestas' => 'integer'
    ];

    /**
     * Cliente que publicó el trabajo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    /**
     * Freelancer asignado al trabajo
     */
    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    /**
     * Categoría del trabajo
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Propuestas recibidas para este trabajo
     */
    public function propuestas(): HasMany
    {
        return $this->hasMany(Propuesta::class);
    }

    /**
     * Habilidades requeridas
     */
    public function habilidades(): BelongsToMany
    {
        return $this->belongsToMany(Habilidad::class, 'trabajo_habilidad');
    }

    /**
     * Entregas realizadas para este trabajo
     */
    public function entregas(): HasMany
    {
        return $this->hasMany(Entrega::class);
    }

    /**
     * Calificaciones del trabajo
     */
    public function calificaciones(): HasMany
    {
        return $this->hasMany(Calificacion::class);
    }

    /**
     * Obtener la última entrega
     */
    public function ultimaEntrega()
    {
        return $this->hasOne(Entrega::class)->latestOfMany();
    }

    /**
     * Scopes para filtrar trabajos
     */
    public function scopePublicados($query)
    {
        return $query->where('estado', 'publicado');
    }

    public function scopeEnProgreso($query)
    {
        return $query->where('estado', 'en_progreso');
    }

    public function scopeCompletados($query)
    {
        return $query->where('estado', 'completado');
    }

    public function scopeDelCliente($query, $clienteId)
    {
        return $query->where('cliente_id', $clienteId);
    }

    public function scopeDelFreelancer($query, $freelancerId)
    {
        return $query->where('freelancer_id', $freelancerId);
    }
}
