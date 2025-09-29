<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditMaintenanceTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'energy_audit_id',
        'maintenance_visit_id',
        'recommendation_applied',
        'notes',
    ];

    protected $casts = [
        'recommendation_applied' => 'boolean',
    ];

    // Relationships
    public function energyAudit()
    {
        return $this->belongsTo(EnergyAudit::class);
    }

    public function maintenanceVisit()
    {
        return $this->belongsTo(MaintenanceVisit::class);
    }

    // Scopes
    public function scopeApplied($query)
    {
        return $query->where('recommendation_applied', true);
    }

    public function scopePending($query)
    {
        return $query->where('recommendation_applied', false);
    }

    // Methods
    public function isApplied()
    {
        return $this->recommendation_applied;
    }
}