<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'content',
        'topic_id',
        'user_id',
    ];
//Один пост принадлежит одной теме
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }
//Один пост принадлежит одному пользователю
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
