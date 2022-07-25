<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'description',
        'use'
    ];

    public function mediable(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
