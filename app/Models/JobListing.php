<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class JobListing extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'requirements',
        'location',
        'type',
        'department',
        'salary_min',
        'salary_max',
        'currency',
        'is_active',
        'expires_at',
        'meta',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'expires_at' => 'datetime',
        'meta' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'is_active', 'expires_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Job listing {$eventName}");
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }
}
