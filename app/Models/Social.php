<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function getPhoneNumber(): ?string {
        return (new static)->firstWhere('name', 'phone')->data;
    }

    protected $fillable = ['name', 'data'];
}
