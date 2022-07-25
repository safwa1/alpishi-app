<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticMessages extends Model
{
    use HasFactory;

    // Expiration_date
    protected $fillable = ['message', 'type', 'state', 'show_at', 'expires_at'];
}
