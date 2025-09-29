@extends('layouts.app')

@section('title', 'Dashboard - BabiEnergies')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
                    <p class="text-muted mb-0">Manage your energy services and track your progress</p>
                </div>
                <div class="d-flex gap-2">
                    @if(Auth::user()->isAdmin())
                        <a href="/admin" class="btn btn-outline-primary">
                            <i class="bi bi-gear me-1"></i>Admin Panel
                        </a>
                    @endif
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quickActionModal">
                        <i class="bi bi-plus-circle me-1"></i>Quick Action
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="row g-4 mb-4">
        <!-- Energy Audits Card -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-gradient-success text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="bi bi-clipboard-data me-2"></i>Energy Audits
                        </h6>
                        <span class="badge bg-light text-dark">{{ $auditCount ?? 0 }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <h4 class="text-success">{{ $scheduledAudits ?? 0 }}</h4>
                            <small class="text-muted">Scheduled</small>
                        </div>
                        <div class="col-4">
                            <h4 class="text-warning">{{ $inProgressAudits ?? 0 }}</h4>
                            <small class="text-muted">In Progress</small>
                        </div>
                        <div class="col-4">
                            <h4 class="text-primary">{{ $completedAudits ?? 0 }}</h4>
                            <small class="text-muted">Completed</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('energy-audit.index') }}" class="btn btn-success btn-sm w-100">
                        <i class="bi bi-eye me-1"></i>View All Audits
                    </a>
                </div>
            </div>
        </div>

        <!-- Solar Installations Card -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-gradient-warning text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="bi bi-sun me-2"></i>Solar Installations
                        </h6>
                        <span class="badge bg-light text-dark">{{ $installationCount ?? 0 }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h4 class="text-warning">{{ $activeInstallations ?? 0 }}</h4>
                            <small class="text-muted">Active</small>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success">{{ $completedInstallations ?? 0 }}</h4>
                            <small class="text-muted">Completed</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('solar-installation.index') }}" class="btn btn-warning btn-sm w-100">
                        <i class="bi bi-eye me-1"></i>View Installations
                    </a>
                </div>
            </div>
        </div>

        <!-- Maintenance Visits Card -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-gradient-info text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="bi bi-tools me-2"></i>Maintenance
                        </h6>
                        <span class="badge bg-light text-dark">{{ $maintenanceCount ?? 0 }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <h4 class="text-info">{{ $upcomingVisits ?? 0 }}</h4>
                            <small class="text-muted">Upcoming</small>
                        </div>
                        <div class="col-4">
                            <h4 class="text-warning">{{ $pendingVisits ?? 0 }}</h4>
                            <small class="text-muted">Pending</small>
                        </div>
                        <div class="col-4">
                            <h4 class="text-success">{{ $completedVisits ?? 0 }}</h4>
                            <small class="text-muted">Completed</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('maintenance.index') }}" class="btn btn-info btn-sm w-100">
                        <i class="bi bi-calendar-plus me-1"></i>Schedule Visit
                    </a>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="bi bi-box-seam me-2"></i>Orders
                        </h6>
                        <span class="badge bg-light text-dark">{{ $orderCount ?? 0 }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h4 class="text-primary">{{ $pendingOrders ?? 0 }}</h4>
                            <small class="text-muted">Pending</small>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success">{{ $completedOrders ?? 0 }}</h4>
                            <small class="text-muted">Completed</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-eye me-1"></i>View Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Activity Timeline and Charts -->
    <div class="row">
        <!-- Recent Activity Timeline -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-clock-history me-2"></i>Recent Activity
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline" id="activityTimeline">
                        <!-- Timeline items will be loaded via JavaScript -->
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Energy Audit Completed</h6>
                                <p class="text-muted mb-1">Your energy audit at 123 Main St was completed by John Smith</p>
                                <small class="text-muted">2 hours ago</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Maintenance Scheduled</h6>
                                <p class="text-muted mb-1">Routine maintenance scheduled for your solar installation</p>
                                <small class="text-muted">1 day ago</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Solar Installation Started</h6>
                                <p class="text-muted mb-1">Installation team has arrived at your property</p>
                                <small class="text-muted">3 days ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-lightning me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('energy-audit.create') }}" class="btn btn-success">
                            <i class="bi bi-clipboard-data me-2"></i>Book Energy Audit
                        </a>
                        <a href="{{ route('solar-request.create') }}" class="btn btn-warning">
                            <i class="bi bi-sun me-2"></i>Request Solar Quote
                        </a>
                        <a href="{{ route('maintenance.create') }}" class="btn btn-info">
                            <i class="bi bi-tools me-2"></i>Schedule Maintenance
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">
                            <i class="bi bi-grid me-2"></i>Browse Products
                        </a>
                    </div>
                    
                    <hr>
                    
                    <h6 class="mb-3">Account Management</h6>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-person me-2"></i>Update Profile
                        </a>
                        <a href="{{ route('cart.index') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-cart me-2"></i>Shopping Cart
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="bi bi-headset me-2"></i>Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Action Modal -->
<div class="modal fade" id="quickActionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-lightning me-2"></i>Quick Actions
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-6">
                        <a href="{{ route('energy-audit.create') }}" class="btn btn-success w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="bi bi-clipboard-data fs-2 mb-2"></i>
                            <span>Book Audit</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('solar-request.create') }}" class="btn btn-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="bi bi-sun fs-2 mb-2"></i>
                            <span>Solar Quote</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('maintenance.create') }}" class="btn btn-info w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="bi bi-tools fs-2 mb-2"></i>
                            <span>Maintenance</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('products.index') }}" class="btn btn-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="bi bi-grid fs-2 mb-2"></i>
                            <span>Products</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for Timeline -->
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0 0 2px #dee2e6;
}

.timeline-content {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 3px solid #22c55e;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
}
</style>

<!-- JavaScript for Dashboard -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize dashboard functionality
    const dashboard = new DashboardManager();
    dashboard.init();
});

class DashboardManager {
    constructor() {
        this.socket = null;
    }

    async init() {
        await this.loadDashboardData();
        this.setupRealTimeUpdates();
        this.setupEventListeners();
    }

    async loadDashboardData() {
        try {
            // Load dashboard statistics
            const response = await fetch('/api/dashboard/stats');
            const data = await response.json();
            
            // Update dashboard cards with real data
            this.updateDashboardCards(data);
        } catch (error) {
            console.error('Error loading dashboard data:', error);
        }
    }

    updateDashboardCards(data) {
        // Update audit counts
        if (data.audits) {
            document.querySelector('.col-lg-3:nth-child(1) .text-success').textContent = data.audits.scheduled || 0;
            document.querySelector('.col-lg-3:nth-child(1) .text-warning').textContent = data.audits.inProgress || 0;
            document.querySelector('.col-lg-3:nth-child(1) .text-primary').textContent = data.audits.completed || 0;
        }
    }

    setupRealTimeUpdates() {
        // WebSocket connection for real-time updates
        if (typeof WebSocket !== 'undefined') {
            this.socket = new WebSocket('ws://localhost:6001');
            
            this.socket.onmessage = (event) => {
                const data = JSON.parse(event.data);
                this.handleRealTimeUpdate(data);
            };
        }
    }

    handleRealTimeUpdate(data) {
        switch(data.type) {
            case 'audit_status_changed':
                this.showNotification('Energy audit status updated');
                this.loadDashboardData();
                break;
            case 'maintenance_scheduled':
                this.showNotification('New maintenance visit scheduled');
                this.loadDashboardData();
                break;
        }
    }

    showNotification(message) {
        // Create and show Bootstrap toast notification
        const toast = document.createElement('div');
        toast.className = 'toast align-items-center text-white bg-success border-0';
        toast.setAttribute('role', 'alert');
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        
        document.body.appendChild(toast);
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
        
        // Remove toast after it's hidden
        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });
    }

    setupEventListeners() {
        // Add any additional event listeners here
    }
}
</script>
@endsection
