<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'section',
        'sort_order',
        'status'
    ];

    // Get footer links by section
    public static function getBySection($section)
    {
        return self::where('section', $section)
                   ->where('status', 1)
                   ->orderBy('sort_order')
                   ->get();
    }

    // Get all sections
    public static function getSections()
    {
        return [
            'quick_links' => 'Quick Links',
            'customer_service' => 'Customer Service',
            'contact_info' => 'Contact Info'
        ];
    }
}
