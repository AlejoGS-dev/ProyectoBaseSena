<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entrega extends Model
{
    use HasFactory;

    protected $fillable = [
        'trabajo_id',
        'freelancer_id',
        'mensaje',
        'repositorio_url',
        'demo_url',
        'archivos',
        'revision',
        'estado',
        'feedback_cliente',
        'aprobada_en',
        'rechazada_en',
    ];

    protected $casts = [
        'archivos' => 'array',
        'aprobada_en' => 'datetime',
        'rechazada_en' => 'datetime',
    ];

    // Relación con el trabajo
    public function trabajo()
    {
        return $this->belongsTo(Trabajo::class);
    }

    // Relación con el freelancer
    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    // Scope para obtener solo entregas pendientes de revisión
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente_revision');
    }

    // Scope para obtener entregas aprobadas
    public function scopeAprobadas($query)
    {
        return $query->where('estado', 'aprobada');
    }

    // Scope para obtener entregas rechazadas
    public function scopeRechazadas($query)
    {
        return $query->where('estado', 'rechazada');
    }
}
