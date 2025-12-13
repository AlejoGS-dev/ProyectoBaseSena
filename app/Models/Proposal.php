<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'freelancer_id',
        'cover_letter',
        'proposed_amount',
        'delivery_days',
        'status',
    ];

    protected $casts = [
        'proposed_amount' => 'decimal:2',
    ];

    public function job()
    {
        return $this->belongsTo(WorkspaceJob::class, 'job_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}
