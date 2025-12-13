<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkspaceJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'freelancer_id',
        'title',
        'description',
        'category',
        'budget',
        'budget_type',
        'status',
        'deadline',
        'skills',
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'deadline' => 'date',
        'skills' => 'array',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'job_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'job_id');
    }
}
