<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titulo',
        'descripcion',
        'imagen',
        'url_demo',
        'categoria_id',
        'tecnologias',
        'fecha_inicio',
        'fecha_fin',
        'orden',
        'destacado',
    ];

    protected $casts = [
        'tecnologias' => 'array',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'destacado' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
