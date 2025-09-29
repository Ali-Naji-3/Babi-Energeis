@extends('layouts.app')

@section('title', 'Technician Dashboard - BabiEnergies')

@section('content')
<div class="container-fluid py-4">
    <!-- Technician Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">Technician Dashboard</h1>
                    <p class="text-muted mb-0">Manage your workload and track your performance</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#availabilityModal">
                        <i class="bi bi-calendar-check me-1"></i>Update Availability
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quickActionModal">
                        <i class="bi bi-plus-circle me-1"></i>Quick Action
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Technician Stats -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-clipboard-check text-success fs-1"></i>
                    <h5 class="card-title">Today's Tasks</h5>
                    <h3 class="text-primary">{{ $todayTasks ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-clock-history text-warning fs-1"></i>
                    <h5 class="card-title">This Week</h5>
                    <h3 class="text-warning">{{ $weekTasks ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-star text-info fs-1"></i>
                    <h5 class="card-title">Rating</h5>
                    <h3 class="text-info">{{ $averageRating ?? '4.8' }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-currency-dollar text-success fs-1"></i>
                    <h5 class="card-title">Earnings</h5>
                    <h3 class="text-success">${{ $monthlyEarnings ?? '0' }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Schedule Calendar -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-calendar-week me-2"></i>My Schedule
                    </h5>
                </div>
                <div class="card-body">
                    <div id="technicianCalendar"></div>
                </div>
            </div>
        </div>

        <!-- Today's Tasks -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-list-task me-2"></i>Today's Tasks
                    </h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush" id="todayTasks">
                        <!-- Tasks will be loaded via JavaScript -->
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Energy Audit - 123 Main St</h6>
                                <small class="text-muted">9:00 AM - 11:00 AM</small>
                            </div>
                            <span class="badge bg-primary">Scheduled</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Maintenance - Solar Panel</h6>
                                <small class="text-muted">2:00 PM - 4:00 PM</small>
                            </div>
                            <span class="badge bg-warning">Pending</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Charts -->
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-graph-up me-2"></i>Performance Trends
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="performanceChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-pie-chart me-2"></i>Task Distribution
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="taskDistributionChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Availability Modal -->
<div class="modal fade" id="availabilityModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-calendar-check me-2"></i>Update Availability
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="availabilityForm">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Available Days</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="monday" name="days[]" value="monday">
                                <label class="form-check-label" for="monday">Monday</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="tuesday" name="days[]" value="tuesday">
                                <label class="form-check-label" for="tuesday">Tuesday</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="wednesday" name="days[]" value="wednesday">
                                <label class="form-check-label" for="wednesday">Wednesday</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="thursday" name="days[]" value="thursday">
                                <label class="form-check-label" for="thursday">Thursday</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="friday" name="days[]" value="friday">
                                <label class="form-check-label" for="friday">Friday</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Working Hours</label>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Start Time</label>
                                    <input type="time" class="form-control" name="start_time" value="08:00">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">End Time</label>
                                    <input type="time" class="form-control" name="end_time" value="17:00">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="updateAvailability()">Update Availability</button>
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
                        <button class="btn btn-success w-100 h-100 d-flex flex-column align-items-center justify-content-center" onclick="startTask('audit')">
                            <i class="bi bi-clipboard-data fs-2 mb-2"></i>
                            <span>Start Audit</span>
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center" onclick="startTask('maintenance')">
                            <i class="bi bi-tools fs-2 mb-2"></i>
                            <span>Maintenance</span>
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-info w-100 h-100 d-flex flex-column align-items-center justify-content-center" onclick="updateStatus('available')">
                            <i class="bi bi-person-check fs-2 mb-2"></i>
                            <span>Available</span>
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-danger w-100 h-100 d-flex flex-column align-items-center justify-content-center" onclick="updateStatus('busy')">
                            <i class="bi bi-person-workspace fs-2 mb-2"></i>
                            <span>Busy</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Technician Dashboard -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const technicianDashboard = new TechnicianDashboard();
    technicianDashboard.init();
});

class TechnicianDashboard {
    constructor() {
        this.calendar = null;
        this.charts = {};
    }

    async init() {
        await this.loadTechnicianData();
        this.setupCalendar();
        this.setupCharts();
        this.setupEventListeners();
    }

    async loadTechnicianData() {
        try {
            const response = await fetch('/api/technician/dashboard');
            const data = await response.json();
            
            this.updateDashboardStats(data);
            this.renderTodayTasks(data.todayTasks || []);
        } catch (error) {
            console.error('Error loading technician data:', error);
        }
    }

    updateDashboardStats(data) {
        // Update stats cards
        document.querySelector('.col-lg-3:nth-child(1) h3').textContent = data.todayTasks || 0;
        document.querySelector('.col-lg-3:nth-child(2) h3').textContent = data.weekTasks || 0;
        document.querySelector('.col-lg-3:nth-child(3) h3').textContent = data.averageRating || '4.8';
        document.querySelector('.col-lg-3:nth-child(4) h3').textContent = '$' + (data.monthlyEarnings || 0);
    }

    renderTodayTasks(tasks) {
        const container = document.getElementById('todayTasks');
        if (!container) return;

        container.innerHTML = tasks.map(task => `
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">${task.title}</h6>
                    <small class="text-muted">${task.time}</small>
                </div>
                <span class="badge bg-${this.getStatusColor(task.status)}">${task.status}</span>
            </div>
        `).join('');
    }

    getStatusColor(status) {
        const colors = {
            'scheduled': 'primary',
            'in_progress': 'warning',
            'completed': 'success',
            'pending': 'warning'
        };
        return colors[status] || 'secondary';
    }

    setupCalendar() {
        const calendarEl = document.getElementById('technicianCalendar');
        if (!calendarEl) return;

        this.calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: this.getCalendarEvents(),
            selectable: true,
            select: this.handleDateSelect.bind(this),
            eventClick: this.handleEventClick.bind(this)
        });
        this.calendar.render();
    }

    getCalendarEvents() {
        // Return calendar events - this would be loaded from API
        return [
            {
                title: 'Energy Audit - 123 Main St',
                start: new Date(),
                color: '#22c55e'
            },
            {
                title: 'Maintenance - Solar Panel',
                start: new Date(Date.now() + 24 * 60 * 60 * 1000),
                color: '#3b82f6'
            }
        ];
    }

    handleDateSelect(selectInfo) {
        this.showScheduleModal(selectInfo.start, selectInfo.end);
    }

    handleEventClick(clickInfo) {
        this.showEventDetails(clickInfo.event);
    }

    setupCharts() {
        this.setupPerformanceChart();
        this.setupTaskDistributionChart();
    }

    setupPerformanceChart() {
        const ctx = document.getElementById('performanceChart').getContext('2d');
        this.charts.performance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Tasks Completed',
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: '#22c55e',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    }

    setupTaskDistributionChart() {
        const ctx = document.getElementById('taskDistributionChart').getContext('2d');
        this.charts.taskDistribution = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Energy Audits', 'Maintenance', 'Installations'],
                datasets: [{
                    data: [30, 50, 20],
                    backgroundColor: ['#22c55e', '#3b82f6', '#f59e0b']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    }

    setupEventListeners() {
        // Add event listeners for technician-specific functionality
    }
}

// Global functions for modal actions
function updateAvailability() {
    const form = document.getElementById('availabilityForm');
    const formData = new FormData(form);
    
    // Process availability data
    console.log('Updating availability:', Object.fromEntries(formData));
    
    // Close modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('availabilityModal'));
    modal.hide();
}

function startTask(type) {
    console.log('Starting task:', type);
    // Implement task starting logic
}

function updateStatus(status) {
    console.log('Updating status to:', status);
    // Implement status update logic
}
</script>
@endsection
