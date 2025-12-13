<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'bio',
        'location',
        'hourly_rate',
        'years_experience',
        'jobs_completed',
        'rating',
        'total_earned',
        'success_rate',
        'github_url',
        'linkedin_url',
        'behance_url',
        'website_url',
    ];

    protected $casts = [
        'hourly_rate' => 'decimal:2',
        'rating' => 'decimal:2',
        'total_earned' => 'decimal:2',
        'success_rate' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function portfolioItems()
    {
        return $this->hasMany(PortfolioItem::class, 'freelancer_id', 'user_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'to_user_id', 'user_id');
    }
}
