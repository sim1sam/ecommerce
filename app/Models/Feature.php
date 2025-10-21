<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'sort_order',
        'status'
    ];

    // Get active features ordered by sort_order
    public static function getActiveFeatures()
    {
        return self::where('status', 1)
                   ->orderBy('sort_order')
                   ->get();
    }
}
