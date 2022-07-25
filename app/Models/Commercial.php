<?php

namespace App\Models;

use App\Utils\FileUtil;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\ArrayShape;

class Commercial extends Model
{
    use HasFactory;

    protected $fillable = ['car_id', 'price', 'counter', 'cost', 'sold', 'description', 'location'];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function mediable(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    #[ArrayShape(['car_id' => "string", 'price' => "string", 'counter' => "string", 'cost' => "string", 'sold' => "string", 'description' => "string", 'location' => "string"])]
    public static function defaultDataShape(): array {
        return [
            'car_id' => '',
            'price' => '',
            'counter' => '',
            'cost' => '',
            'sold' => '',
            'description' => '',
            'location' => ''
        ];
    }


    public function getCarImageUrl(): string
    {
        return FileUtil::storageUrl($this->car->mediable->path);
    }

    public function getCarBrand(): string
    {
        return $this->car->brand;
    }

    public function getCarName(): string
    {
        return $this->car->model;
    }

    public function getCarReleaseDate(): string
    {
        return $this->car->releaseDate;
    }

    public function getDescriptionLines(): Collection
    {
        return str($this->description)->split('/\r\n|\n|\r/');
    }
}
