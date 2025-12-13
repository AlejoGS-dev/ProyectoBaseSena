<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'from_user_id',
        'to_user_id',
        'overall_rating',
        'communication',
        'quality',
        'timeliness',
        'professionalism',
        'comment',
    ];

    protected $casts = [
        'overall_rating' => 'decimal:2',
    ];

    public function job()
    {
        return $this->belongsTo(WorkspaceJob::class, 'job_id');
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}
