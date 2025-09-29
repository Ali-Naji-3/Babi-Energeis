<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyAudit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'technician_id',
        'property_type',
        'property_address',
        'property_size',
        'current_energy_usage',
        'audit_date',
        'audit_status',
        'recommendations',
        'estimated_savings',
        'report_file',
        'notes',
    ];

    protected $casts = [
        'current_energy_usage' => 'decimal:2',
        'estimated_savings' => 'decimal:2',
        'audit_date' => 'date',
        'recommendations' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }

    public function solarInstallations()
    {
        return $this->hasMany(SolarInstallation::class);
    }

    // Scopes
    public function scopeScheduled($query)
    {
        return $query->where('audit_status', 'scheduled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('audit_status', 'completed');
    }

    public function scopeInProgress($query)
    {
        return $query->where('audit_status', 'in_progress');
    }

    // Methods
    public function isCompleted()
    {
        return $this->audit_status === 'completed';
    }

    public function isScheduled()
    {
        return $this->audit_status === 'scheduled';
    }
}