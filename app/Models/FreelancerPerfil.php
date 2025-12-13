<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerPerfil extends Model
{
    protected $table = 'freelancer_perfiles';

    protected $fillable = [
        'user_id',
        'titulo_profesional',
        'biografia',
        'ubicacion',
        'tarifa_por_hora',
        'anos_experiencia',
        'disponibilidad',
        'disponible_ahora',
        'trabajos_completados',
        'calificacion_promedio',
        'total_calificaciones',
        'total_ganado',
        'propuestas_exitosas',
        'total_propuestas',
        'linkedin',
        'github',
        'behance',
        'website',
        'categorias_preferidas'
    ];

    protected $casts = [
        'tarifa_por_hora' => 'decimal:2',
        'calificacion_promedio' => 'decimal:2',
        'total_ganado' => 'decimal:2',
        'disponible_ahora' => 'boolean',
        'categorias_preferidas' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function habilidades()
    {
        return $this->belongsToMany(Habilidad::class, 'freelancer_perfil_habilidad');
    }

    /**
     * Calcular tasa de éxito de propuestas
     */
    public function getTasaExitoAttribute()
    {
        if ($this->total_propuestas == 0) return 0;
        return round(($this->propuestas_exitosas / $this->total_propuestas) * 100, 1);
    }
}
