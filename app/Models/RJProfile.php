<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RJProfile extends Model
{
    use HasFactory , HasUuids;

    protected $fillable = [
        'name',
        'image',
        'details',
        'duty_time',
        'status',
    ];
}
