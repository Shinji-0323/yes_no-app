<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'beauty_count',
        'period_count',
        'menopause_count',
        'total_count',
    ];
}
