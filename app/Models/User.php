<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'activo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function entradas(){
        return $this->hasMany(Entrada::class);
    }

    // Workspace relationships
    public function freelancerProfile()
    {
        return $this->hasOne(FreelancerPerfil::class, 'user_id');
    }

    public function trabajosComoCliente()
    {
        return $this->hasMany(Trabajo::class, 'cliente_id');
    }

    public function trabajosComoFreelancer()
    {
        return $this->hasMany(Trabajo::class, 'freelancer_id');
    }

    public function propuestas()
    {
        return $this->hasMany(Propuesta::class, 'freelancer_id');
    }

    public function portfolioItems()
    {
        return $this->hasMany(PortfolioItem::class, 'user_id');
    }

    public function calificacionesDadas()
    {
        return $this->hasMany(Calificacion::class, 'evaluador_id');
    }

    public function calificacionesRecibidas()
    {
        return $this->hasMany(Calificacion::class, 'evaluado_id');
    }
}
