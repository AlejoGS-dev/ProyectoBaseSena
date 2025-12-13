<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Propuesta extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'trabajo_id',
        'freelancer_id',
        'carta_presentacion',
        'tarifa_propuesta',
        'tipo_tarifa',
        'tiempo_estimado',
        'estado',
        'archivos_adjuntos',
        'aceptada_en',
        'rechazada_en',
        'vista_por_cliente_en'
    ];

    protected $casts = [
        'tarifa_propuesta' => 'decimal:2',
        'tiempo_estimado' => 'integer',
        'archivos_adjuntos' => 'array',
        'aceptada_en' => 'datetime',
        'rechazada_en' => 'datetime',
        'vista_por_cliente_en' => 'datetime'
    ];

    /**
     * Trabajo al que pertenece la propuesta
     */
    public function trabajo(): BelongsTo
    {
        return $this->belongsTo(Trabajo::class);
    }

    /**
     * Freelancer que envió la propuesta
     */
    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    /**
     * Scopes
     */
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeAceptadas($query)
    {
        return $query->where('estado', 'aceptada');
    }

    public function scopeDelFreelancer($query, $freelancerId)
    {
        return $query->where('freelancer_id', $freelancerId);
    }

    public function scopeDelTrabajo($query, $trabajoId)
    {
        return $query->where('trabajo_id', $trabajoId);
    }
}
