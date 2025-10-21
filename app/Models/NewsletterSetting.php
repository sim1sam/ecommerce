<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSetting extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'background_color',
        'text_color',
        'button_text',
        'button_color',
        'status'
    ];

    // Get active newsletter settings
    public static function getActiveSettings()
    {
        return self::where('status', 1)->first();
    }
}
