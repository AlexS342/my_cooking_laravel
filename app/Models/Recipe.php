<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    use HasFactory;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function actions(): HasMany
    {
        return $this->hasMany(Action::class);
    }

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'full_time',
        'portion',
    ];
}
