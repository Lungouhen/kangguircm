<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class)->orderBy('order');
    }

    public function activeItems()
    {
        return $this->items()->where('is_active', true)->orderBy('order');
    }

    public static function getByLocation(string $location): ?self
    {
        return static::where('location', $location)
            ->where('is_active', true)
            ->first();
    }
}
