<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'solar_installation_id',
        'technician_id',
        'visit_date',
        'visit_type',
        'status',
        'notes',
        'photos',
        'parts_used',
        'cost',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'photos' => 'array',
        'parts_used' => 'array',
        'cost' => 'decimal:2',
    ];

    // Relationships
    public function solarInstallation()
    {
        return $this->belongsTo(SolarInstallation::class);
    }

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }

    // Scopes
    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeRoutine($query)
    {
        return $query->where('visit_type', 'routine');
    }

    public function scopeRepair($query)
    {
        return $query->where('visit_type', 'repair');
    }

    // Methods
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isScheduled()
    {
        return $this->status === 'scheduled';
    }
}