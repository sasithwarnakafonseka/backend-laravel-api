<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferenceFilter extends Model
{
    use HasFactory;

    protected $table = 'preferences_filters';

    protected $fillable = [
        'search',
        'category',
        'source',
        'start_date',
        'end_date',
        'user_id',
    ];

    // Define any relationships or additional methods as needed
}