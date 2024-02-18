<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'status',
        'destination',
        'last_access',
        'created_at',
        'updated_at',
    ];
}
