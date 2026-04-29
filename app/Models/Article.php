<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'user_id'
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function category()
    {
        return $this->BelongsTo(Category::class);
    }

}
