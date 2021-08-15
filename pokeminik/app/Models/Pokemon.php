<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'moves' => 'array',
        'types' => 'array',
        'stats' => 'array',
        'sprites' => 'array',
    ];
}
