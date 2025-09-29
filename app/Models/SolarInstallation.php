<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarInstallation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'energy_audit_id',
        'technician_id',
        'system_size',
        'panel_count',
        'estimated_production',
        'installation_date',
        'completion_date',
        'status',
        'project_files',
        'warranty_period',
        'notes',
    ];

    protected $casts = [
        'system_size' => 'decimal:2',
        'estimated_production' => 'decimal:2',
        'installation_date' => 'date',
        'completion_date' => 'date',
        'project_files' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function energyAudit()
    {
        return $this->belongsTo(EnergyAudit::class);
    }

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }

    public function maintenanceVisits()
    {
        return $this->hasMany(MaintenanceVisit::class);
    }

    // Scopes
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    // Methods
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isInProgress()
    {
        return $this->status === 'in_progress';
    }

    public function getProgressPercentage()
    {
        if ($this->status === 'quoted') return 10;
        if ($this->status === 'approved') return 25;
        if ($this->status === 'in_progress') return 75;
        if ($this->status === 'completed') return 100;
        return 0;
    }
}