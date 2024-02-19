<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Redirect extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'status',
        'destination',
        'last_access',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
