<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'slug',
        'description',
        'is_active',
        'content',
        'styles',
        'background_type',
        'background_value',
        'padding',
    ];

    protected $casts = [
        'content' => 'array',
        'styles' => 'array',
        'is_active' => 'boolean',
    ];

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_blocks')
            ->withPivot('page_type', 'page_identifier', 'order', 'is_active')
            ->orderByPivot('order');
    }

    public static function getByType(string $type)
    {
        return static::where('type', $type)->where('is_active', true)->get();
    }

    public static function forPage(string $pageType, ?string $identifier = null)
    {
        return static::join('page_blocks', 'blocks.id', '=', 'page_blocks.block_id')
            ->where('page_blocks.page_type', $pageType)
            ->where('page_blocks.is_active', true)
            ->where('blocks.is_active', true)
            ->when($identifier, fn ($q) => $q->where('page_blocks.page_identifier', $identifier))
            ->orderBy('page_blocks.order')
            ->select('blocks.*')
            ->get();
    }
}
