<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Post extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'author_id',
        'category_id',
        'featured_image',
        'status',
        'published_at',
        'views_count',
        'meta',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views_count' => 'integer',
        'meta' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'status', 'published_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Post {$eventName}");
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }
}
