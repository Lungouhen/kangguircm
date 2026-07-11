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
        'layout_variant',
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

    public function pageAssignments()
    {
        return $this->hasMany(PageBlock::class);
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

    public function getContentAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }
}
