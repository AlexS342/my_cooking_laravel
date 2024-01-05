<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Action extends Model
{
    use HasFactory;
    public $timestamps = false; //Отменяем автоматическое создание полей created_at и updated_at
    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }
}
