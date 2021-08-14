<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'sprites' => 'array',
        'flavor_text_entries' => 'array',
        'category' => 'array'
    ];
}
