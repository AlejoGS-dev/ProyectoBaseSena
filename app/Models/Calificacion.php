<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table = 'calificaciones';

    protected $fillable = [
        'trabajo_id',
        'evaluador_id',
        'evaluado_id',
        'tipo',
        'calificacion',
        'comentario',
        'comunicacion',
        'calidad_trabajo',
        'cumplimiento_plazo',
        'profesionalismo',
        'verificado'
    ];

    protected $casts = [
        'verificado' => 'boolean',
    ];

    public function trabajo()
    {
        return $this->belongsTo(Trabajo::class);
    }

    public function evaluador()
    {
        return $this->belongsTo(User::class, 'evaluador_id');
    }

    public function evaluado()
    {
        return $this->belongsTo(User::class, 'evaluado_id');
    }

    /**
     * Calcular promedio de aspectos
     */
    public function getPromedioAspectosAttribute()
    {
        $aspectos = array_filter([
            $this->comunicacion,
            $this->calidad_trabajo,
            $this->cumplimiento_plazo,
            $this->profesionalismo
        ]);

        if (empty($aspectos)) return $this->calificacion;

        return round(array_sum($aspectos) / count($aspectos), 1);
    }
}
