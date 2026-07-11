<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class JobApplication extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'job_id',
        'name',
        'email',
        'phone',
        'resume_path',
        'cover_letter_path',
        'message',
        'status',
        'notes',
        'parsed_skills',
        'parsed_experience',
        'match_score',
        'is_auto_rejected',
    ];

    protected $casts = [
        'job_id' => 'integer',
        'parsed_skills' => 'array',
        'match_score' => 'decimal:2',
        'is_auto_rejected' => 'boolean',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'notes'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Job application {$eventName}");
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(JobListing::class, 'job_id');
    }
}
