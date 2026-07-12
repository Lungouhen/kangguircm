<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'parent_id',
        'title',
        'url',
        'is_mega_menu',
        'mega_menu_content',
        'route',
        'route_parameters',
        'target',
        'icon',
        'order',
        'is_active',
    ];

    protected $casts = [
        'route_parameters' => 'array',
        'is_active' => 'boolean',
        'is_mega_menu' => 'boolean',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    public function activeChildren()
    {
        return $this->children()->where('is_active', true);
    }

    public function getUrlAttribute(): string
    {
        $rawUrl = $this->attributes['url'] ?? null;

        if ($rawUrl) {
            return $rawUrl;
        }

        if ($this->route) {
            return route($this->route, $this->route_parameters ?? []);
        }

        return '#';
    }

    public function isActiveRoute(): bool
    {
        if (!$this->route) {
            return false;
        }

        return request()->routeIs($this->route);
    }
}
