<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'title',
        'content',
        'status', // 'status' attribute to track post visibility status
    ];

    // Define relationship with User (author of the post)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
