<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'body',
        'reviewer_id',
        'feedbackable_id',
        'feedbackable_type'
    ];

    public function feedbackable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsto(User::class, 'reviewer_id', 'id');
    }
}
