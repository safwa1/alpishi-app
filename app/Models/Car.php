<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'releaseDate',
    ];

    public function mediable(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable');
    }

    public function commercials() {
        $this->hasMany(Commercial::class, 'car_id');
    }
}
