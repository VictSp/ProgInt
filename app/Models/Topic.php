<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    protected $fillable = [
        'title',
        'category_id',
        'user_id',
    ];
//Одна тема принадлежит одной категории
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
//Одна тема принадлежит одному пользователю
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
//Одна тема имеет много постов
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
