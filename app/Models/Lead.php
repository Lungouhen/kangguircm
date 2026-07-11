<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Lead extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'source',
        'status',
        'notes',
        'assigned_to',
        'follow_up_at',
    ];

    protected $casts = [
        'follow_up_at' => 'datetime',
        'assigned_to' => 'integer',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'notes', 'assigned_to', 'follow_up_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Lead {$eventName}");
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
