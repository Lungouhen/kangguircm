<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
        'is_default',
        'colors',
        'typography',
        'layout',
        'custom_css',
        'custom_js',
        'logo_light',
        'logo_dark',
        'favicon',
    ];

    protected $casts = [
        'colors' => 'array',
        'typography' => 'array',
        'layout' => 'array',
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];

    public static function active(): ?self
    {
        return static::where('is_active', true)->first() ?? static::where('is_default', true)->first();
    }

    public static function defaultTheme(): self
    {
        return static::where('is_default', true)->first() ?? static::firstOrCreate([
            'slug' => 'default',
        ], [
            'name' => 'Default Theme',
            'description' => 'Default Kanggui RCM theme',
            'is_default' => true,
            'is_active' => true,
            'colors' => [
                'primary' => '#2563EB',
                'secondary' => '#4F46E5',
                'accent' => '#06B6D4',
                'background' => '#FFFFFF',
                'text' => '#1F2937',
            ],
            'typography' => [
                'font_family' => 'Instrument Sans',
                'heading_font' => 'Instrument Sans',
                'base_size' => '16px',
            ],
            'layout' => [
                'container_width' => 'max-w-7xl',
                'border_radius' => 'lg',
                'spacing' => 'normal',
            ],
        ]);
    }
}
