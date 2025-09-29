// Dashboard Manager Class
class DashboardManager {
    constructor() {
        this.socket = null;
        this.refreshInterval = null;
    }

    async init() {
        await this.loadDashboardData();
        await this.loadRecentActivity();
        this.setupRealTimeUpdates();
        this.setupEventListeners();
        this.setupAutoRefresh();
    }

    async loadDashboardData() {
        try {
            const response = await fetch('/api/dashboard/stats');
            const data = await response.json();
            
            this.updateDashboardCards(data);
        } catch (error) {
            console.error('Error loading dashboard data:', error);
            this.showError('Failed to load dashboard data');
        }
    }

    async loadRecentActivity() {
        try {
            const response = await fetch('/api/dashboard/activity');
            const activities = await response.json();
            
            this.renderActivityTimeline(activities);
        } catch (error) {
            console.error('Error loading recent activity:', error);
        }
    }

    updateDashboardCards(data) {
        // Update Energy Audits card
        this.updateCard('.col-lg-3:nth-child(1)', {
            total: data.auditCount || 0,
            scheduled: data.scheduledAudits || 0,
            inProgress: data.inProgressAudits || 0,
            completed: data.completedAudits || 0
        });

        // Update Solar Installations card
        this.updateCard('.col-lg-3:nth-child(2)', {
            total: data.installationCount || 0,
            active: data.activeInstallations || 0,
            completed: data.completedInstallations || 0
        });

        // Update Maintenance card
        this.updateCard('.col-lg-3:nth-child(3)', {
            total: data.maintenanceCount || 0,
            upcoming: data.upcomingVisits || 0,
            pending: data.pendingVisits || 0,
            completed: data.completedVisits || 0
        });

        // Update Orders card
        this.updateCard('.col-lg-3:nth-child(4)', {
            total: data.orderCount || 0,
            pending: data.pendingOrders || 0,
            completed: data.completedOrders || 0
        });
    }

    updateCard(selector, data) {
        const card = document.querySelector(selector);
        if (!card) return;

        // Update total count in badge
        const badge = card.querySelector('.badge');
        if (badge) {
            badge.textContent = data.total;
        }

        // Update individual counts
        const counts = card.querySelectorAll('h4');
        if (counts.length >= 3) {
            counts[0].textContent = data.scheduled || data.active || data.upcoming || data.pending || 0;
            counts[1].textContent = data.inProgress || data.completed || data.pending || data.completed || 0;
            counts[2].textContent = data.completed || 0;
        }
    }

    renderActivityTimeline(activities) {
        const timeline = document.getElementById('activityTimeline');
        if (!timeline) return;

        timeline.innerHTML = activities.map(activity => `
            <div class="timeline-item">
                <div class="timeline-marker bg-${this.getStatusColor(activity.status)}"></div>
                <div class="timeline-content">
                    <h6 class="mb-1">${activity.title}</h6>
                    <p class="text-muted mb-1">${activity.description}</p>
                    <small class="text-muted">${this.formatDate(activity.date)}</small>
                </div>
            </div>
        `).join('');
    }

    getStatusColor(status) {
        const colors = {
            'scheduled': 'info',
            'in_progress': 'warning',
            'completed': 'success',
            'pending': 'warning',
            'cancelled': 'danger'
        };
        return colors[status] || 'secondary';
    }

    formatDate(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffInHours = Math.floor((now - date) / (1000 * 60 * 60));
        
        if (diffInHours < 1) {
            return 'Just now';
        } else if (diffInHours < 24) {
            return `${diffInHours} hours ago`;
        } else {
            const diffInDays = Math.floor(diffInHours / 24);
            return `${diffInDays} days ago`;
        }
    }

    setupRealTimeUpdates() {
        // WebSocket connection for real-time updates
        if (typeof WebSocket !== 'undefined') {
            try {
                this.socket = new WebSocket('ws://localhost:6001');
                
                this.socket.onopen = () => {
                    console.log('WebSocket connected');
                };
                
                this.socket.onmessage = (event) => {
                    const data = JSON.parse(event.data);
                    this.handleRealTimeUpdate(data);
                };
                
                this.socket.onclose = () => {
                    console.log('WebSocket disconnected');
                    // Attempt to reconnect after 5 seconds
                    setTimeout(() => {
                        this.setupRealTimeUpdates();
                    }, 5000);
                };
                
                this.socket.onerror = (error) => {
                    console.error('WebSocket error:', error);
                };
            } catch (error) {
                console.log('WebSocket not available, using polling instead');
                this.setupPolling();
            }
        } else {
            this.setupPolling();
        }
    }

    setupPolling() {
        // Fallback to polling every 30 seconds
        this.refreshInterval = setInterval(() => {
            this.loadDashboardData();
            this.loadRecentActivity();
        }, 30000);
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
                this.loadRecentActivity();
                break;
            case 'technician_assigned':
                this.showNotification('Technician assigned to your service');
                this.loadDashboardData();
                break;
            case 'order_status_changed':
                this.showNotification('Order status updated');
                this.loadDashboardData();
                break;
        }
    }

    showNotification(message, type = 'success') {
        // Create toast container if it doesn't exist
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            toastContainer.style.zIndex = '1055';
            document.body.appendChild(toastContainer);
        }

        // Create toast element
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white bg-${type} border-0`;
        toast.setAttribute('role', 'alert');
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        
        toastContainer.appendChild(toast);
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
        
        // Remove toast after it's hidden
        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });
    }

    showError(message) {
        this.showNotification(message, 'danger');
    }

    setupEventListeners() {
        // Refresh button
        const refreshBtn = document.querySelector('[data-action="refresh"]');
        if (refreshBtn) {
            refreshBtn.addEventListener('click', () => {
                this.loadDashboardData();
                this.loadRecentActivity();
            });
        }

        // Card click handlers
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('click', (e) => {
                if (e.target.tagName === 'A') return;
                
                const link = card.querySelector('a');
                if (link) {
                    link.click();
                }
            });
        });
    }

    setupAutoRefresh() {
        // Auto-refresh every 5 minutes
        setInterval(() => {
            this.loadDashboardData();
        }, 300000);
    }

    destroy() {
        if (this.socket) {
            this.socket.close();
        }
        if (this.refreshInterval) {
            clearInterval(this.refreshInterval);
        }
    }
}

// Energy Audit Manager
class EnergyAuditManager {
    constructor() {
        this.audits = [];
        this.lebaneseCities = [
            'Beirut', 'Tripoli', 'Sidon', 'Tyre', 'Zahle', 'Baalbek', 'Jounieh', 'Byblos',
            'Nabatieh', 'Marjayoun', 'Jezzine', 'Aley', 'Baabda', 'Keserwan', 'Batroun'
        ];
        this.propertyTypes = [
            'Residential Villa', 'Apartment Building', 'Commercial Building', 'Industrial Facility',
            'Office Building', 'Retail Store', 'Restaurant', 'Hotel', 'Hospital', 'School'
        ];
    }

    async loadAudits() {
        try {
            const response = await fetch('/api/energy-audits');
            this.audits = await response.json();
            return this.audits;
        } catch (error) {
            console.error('Error loading audits:', error);
            return [];
        }
    }

    async createAudit(auditData) {
        try {
            // Add Lebanese-specific validation
            const validatedData = this.validateLebaneseAuditData(auditData);
            
            const response = await fetch('/api/energy-audits', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(validatedData)
            });
            
            if (response.ok) {
                const result = await response.json();
                this.showNotification('Energy audit request submitted successfully for ' + validatedData.property_address);
                this.loadAudits(); // Refresh the list
                return result;
            } else {
                const error = await response.json();
                throw new Error(error.message || 'Failed to create audit');
            }
        } catch (error) {
            console.error('Error creating audit:', error);
            this.showNotification('Failed to submit audit request: ' + error.message, 'danger');
        }
    }

    validateLebaneseAuditData(data) {
        // Validate Lebanese address format
        if (!data.property_address || !this.isValidLebaneseAddress(data.property_address)) {
            throw new Error('Please provide a valid Lebanese address');
        }

        // Validate property type
        if (!this.propertyTypes.includes(data.property_type)) {
            throw new Error('Please select a valid property type');
        }

        // Add Lebanese-specific recommendations
        data.recommendations = this.generateLebaneseRecommendations(data);
        
        return data;
    }

    isValidLebaneseAddress(address) {
        // Check if address contains Lebanese city names
        return this.lebaneseCities.some(city => 
            address.toLowerCase().includes(city.toLowerCase())
        );
    }

    generateLebaneseRecommendations(auditData) {
        const recommendations = [];
        
        // Solar panel recommendations based on Lebanese climate
        if (auditData.property_type.includes('Residential') || auditData.property_type.includes('Commercial')) {
            recommendations.push('Install solar panels - Lebanon has excellent solar potential with 300+ sunny days per year');
        }
        
        // Energy efficiency recommendations
        recommendations.push('Upgrade to LED lighting - reduce energy consumption by 80%');
        recommendations.push('Install smart thermostats for better temperature control');
        
        // Lebanese-specific recommendations
        if (auditData.property_size > 200) {
            recommendations.push('Consider installing solar water heaters - very effective in Lebanese climate');
        }
        
        if (auditData.property_type.includes('Commercial')) {
            recommendations.push('Implement building automation system for energy management');
        }
        
        return recommendations;
    }

    async getAuditDetails(auditId) {
        try {
            const response = await fetch(`/api/energy-audits/${auditId}`);
            return await response.json();
        } catch (error) {
            console.error('Error loading audit details:', error);
            return null;
        }
    }

    async updateAuditStatus(auditId, status) {
        try {
            const response = await fetch(`/api/energy-audits/${auditId}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status })
            });
            
            if (response.ok) {
                this.showNotification(`Audit status updated to ${status}`);
                return await response.json();
            } else {
                throw new Error('Failed to update audit status');
            }
        } catch (error) {
            console.error('Error updating audit status:', error);
            this.showNotification('Failed to update audit status', 'danger');
        }
    }

    async assignTechnician(auditId, technicianId) {
        try {
            const response = await fetch(`/api/energy-audits/${auditId}/assign-technician`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ technician_id: technicianId })
            });
            
            if (response.ok) {
                this.showNotification('Technician assigned successfully');
                return await response.json();
            } else {
                throw new Error('Failed to assign technician');
            }
        } catch (error) {
            console.error('Error assigning technician:', error);
            this.showNotification('Failed to assign technician', 'danger');
        }
    }

    showNotification(message, type = 'success') {
        const dashboard = window.dashboardManager;
        if (dashboard) {
            dashboard.showNotification(message, type);
        }
    }
}

// Maintenance Manager
class MaintenanceManager {
    constructor() {
        this.visits = [];
        this.lebaneseTechnicians = [];
        this.visitTypes = ['routine', 'repair', 'inspection'];
        this.lebaneseMaintenanceParts = [
            'Solar Panel Cleaning Solution',
            'Inverter Maintenance Kit',
            'Battery Terminal Cleaner',
            'Cable Management System',
            'Weatherproof Sealant',
            'Mounting Hardware Kit'
        ];
    }

    async loadMaintenanceVisits() {
        try {
            const response = await fetch('/api/maintenance-visits');
            this.visits = await response.json();
            return this.visits;
        } catch (error) {
            console.error('Error loading maintenance visits:', error);
            return [];
        }
    }

    async loadLebaneseTechnicians() {
        try {
            const response = await fetch('/api/technicians/lebanon');
            this.lebaneseTechnicians = await response.json();
            return this.lebaneseTechnicians;
        } catch (error) {
            console.error('Error loading Lebanese technicians:', error);
            return [];
        }
    }

    async scheduleVisit(visitData) {
        try {
            // Add Lebanese-specific validation and enhancements
            const enhancedData = this.enhanceLebaneseVisitData(visitData);
            
            const response = await fetch('/api/maintenance-visits', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(enhancedData)
            });
            
            if (response.ok) {
                const result = await response.json();
                this.showNotification(`Maintenance visit scheduled successfully for ${enhancedData.location}`);
                this.loadMaintenanceVisits(); // Refresh the list
                return result;
            } else {
                const error = await response.json();
                throw new Error(error.message || 'Failed to schedule visit');
            }
        } catch (error) {
            console.error('Error scheduling visit:', error);
            this.showNotification('Failed to schedule maintenance visit: ' + error.message, 'danger');
        }
    }

    enhanceLebaneseVisitData(visitData) {
        // Add Lebanese-specific enhancements
        visitData.lebanese_enhancements = {
            weather_considerations: this.getWeatherConsiderations(visitData.visit_date),
            traffic_considerations: this.getTrafficConsiderations(visitData.location),
            local_parts_availability: this.checkLocalPartsAvailability(visitData.visit_type),
            technician_specialization: this.getTechnicianSpecialization(visitData.technician_id)
        };

        // Add Lebanese maintenance recommendations
        visitData.lebanese_recommendations = this.generateLebaneseMaintenanceRecommendations(visitData);
        
        return visitData;
    }

    getWeatherConsiderations(visitDate) {
        const date = new Date(visitDate);
        const month = date.getMonth();
        
        // Lebanese weather patterns
        if (month >= 5 && month <= 9) {
            return 'Summer season - high temperatures, plan for early morning visits';
        } else if (month >= 10 && month <= 11) {
            return 'Autumn season - mild weather, ideal for maintenance';
        } else if (month >= 12 || month <= 2) {
            return 'Winter season - possible rain, check weather forecast';
        } else {
            return 'Spring season - pleasant weather, good for outdoor work';
        }
    }

    getTrafficConsiderations(location) {
        // Lebanese traffic patterns
        if (location.includes('Beirut')) {
            return 'Beirut traffic - allow extra 30 minutes for city center visits';
        } else if (location.includes('Tripoli')) {
            return 'Tripoli area - moderate traffic, allow 15 minutes buffer';
        } else {
            return 'Rural area - minimal traffic delays expected';
        }
    }

    checkLocalPartsAvailability(visitType) {
        const availableParts = {
            'routine': ['Solar Panel Cleaning Solution', 'Cable Management System'],
            'repair': ['Inverter Maintenance Kit', 'Weatherproof Sealant', 'Mounting Hardware Kit'],
            'inspection': ['Battery Terminal Cleaner', 'Multimeter', 'Thermal Camera']
        };
        
        return availableParts[visitType] || [];
    }

    getTechnicianSpecialization(technicianId) {
        const technician = this.lebaneseTechnicians.find(t => t.id === technicianId);
        return technician ? technician.specialization : 'General Maintenance';
    }

    generateLebaneseMaintenanceRecommendations(visitData) {
        const recommendations = [];
        
        // Solar panel specific recommendations for Lebanese climate
        if (visitData.visit_type === 'routine') {
            recommendations.push('Clean solar panels - dust accumulation is common in Lebanese climate');
            recommendations.push('Check for salt corrosion - coastal areas in Lebanon are prone to this');
            recommendations.push('Inspect mounting hardware - high winds in Lebanese mountains can cause issues');
        }
        
        // Lebanese-specific maintenance tips
        if (visitData.location.includes('Beirut')) {
            recommendations.push('Check for urban pollution effects on solar panels');
        }
        
        if (visitData.location.includes('Mount Lebanon') || visitData.location.includes('Keserwan')) {
            recommendations.push('Inspect for mountain weather damage - temperature fluctuations');
        }
        
        return recommendations;
    }

    async updateVisitStatus(visitId, status) {
        try {
            const response = await fetch(`/api/maintenance-visits/${visitId}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status })
            });
            
            if (response.ok) {
                this.showNotification(`Maintenance visit status updated to ${status}`);
                return await response.json();
            } else {
                throw new Error('Failed to update visit status');
            }
        } catch (error) {
            console.error('Error updating visit status:', error);
            this.showNotification('Failed to update visit status', 'danger');
        }
    }

    async addVisitPhotos(visitId, photos) {
        try {
            const formData = new FormData();
            photos.forEach((photo, index) => {
                formData.append(`photos[${index}]`, photo);
            });
            
            const response = await fetch(`/api/maintenance-visits/${visitId}/photos`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });
            
            if (response.ok) {
                this.showNotification('Photos uploaded successfully');
                return await response.json();
            } else {
                throw new Error('Failed to upload photos');
            }
        } catch (error) {
            console.error('Error uploading photos:', error);
            this.showNotification('Failed to upload photos', 'danger');
        }
    }

    async recordPartsUsed(visitId, partsUsed) {
        try {
            const response = await fetch(`/api/maintenance-visits/${visitId}/parts`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ parts_used: partsUsed })
            });
            
            if (response.ok) {
                this.showNotification('Parts usage recorded successfully');
                return await response.json();
            } else {
                throw new Error('Failed to record parts usage');
            }
        } catch (error) {
            console.error('Error recording parts:', error);
            this.showNotification('Failed to record parts usage', 'danger');
        }
    }

    async getUpcomingVisits() {
        try {
            const response = await fetch('/api/maintenance-visits/upcoming');
            return await response.json();
        } catch (error) {
            console.error('Error loading upcoming visits:', error);
            return [];
        }
    }

    async getVisitHistory(installationId) {
        try {
            const response = await fetch(`/api/maintenance-visits/history/${installationId}`);
            return await response.json();
        } catch (error) {
            console.error('Error loading visit history:', error);
            return [];
        }
    }

    showNotification(message, type = 'success') {
        const dashboard = window.dashboardManager;
        if (dashboard) {
            dashboard.showNotification(message, type);
        }
    }
}

// Technician Dashboard Manager
class TechnicianDashboard {
    constructor() {
        this.technician = null;
        this.schedule = [];
        this.lebaneseRegions = [
            'Beirut', 'Mount Lebanon', 'North Lebanon', 'South Lebanon', 
            'Bekaa', 'Nabatieh', 'Akkar', 'Baalbek-Hermel'
        ];
        this.lebaneseSpecializations = [
            'Solar Panel Installation', 'Energy Audit Specialist', 'Electrical Systems',
            'HVAC Systems', 'Energy Efficiency Consultant', 'Renewable Energy Expert'
        ];
    }

    async init() {
        await this.loadTechnicianProfile();
        await this.loadSchedule();
        this.setupCalendar();
        this.setupCharts();
    }

    async loadTechnicianProfile() {
        try {
            const response = await fetch('/api/technician/profile');
            this.technician = await response.json();
            this.updateTechnicianInfo();
        } catch (error) {
            console.error('Error loading technician profile:', error);
        }
    }

    async loadSchedule() {
        try {
            const response = await fetch('/api/technician/schedule');
            this.schedule = await response.json();
            this.renderSchedule();
        } catch (error) {
            console.error('Error loading schedule:', error);
        }
    }

    updateTechnicianInfo() {
        if (!this.technician) return;
        
        // Update dashboard with Lebanese technician data
        document.querySelector('.col-lg-3:nth-child(3) h3').textContent = this.technician.rating || '4.8';
        document.querySelector('.col-lg-3:nth-child(4) h3').textContent = '$' + (this.technician.monthlyEarnings || 0);
    }

    renderSchedule() {
        const container = document.getElementById('todayTasks');
        if (!container) return;

        const todayTasks = this.schedule.filter(task => 
            new Date(task.visit_date).toDateString() === new Date().toDateString()
        );

        container.innerHTML = todayTasks.map(task => `
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">${task.title} - ${task.location}</h6>
                    <small class="text-muted">${this.formatTime(task.start_time)} - ${this.formatTime(task.end_time)}</small>
                </div>
                <span class="badge bg-${this.getStatusColor(task.status)}">${task.status}</span>
            </div>
        `).join('');
    }

    formatTime(timeString) {
        return new Date(`2000-01-01T${timeString}`).toLocaleTimeString('en-US', {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        });
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
            events: this.schedule.map(task => ({
                title: task.title,
                start: task.visit_date,
                color: this.getTaskColor(task.visit_type)
            })),
            selectable: true,
            select: this.handleDateSelect.bind(this)
        });
        this.calendar.render();
    }

    getTaskColor(visitType) {
        const colors = {
            'routine': '#22c55e',
            'repair': '#ef4444',
            'inspection': '#3b82f6'
        };
        return colors[visitType] || '#6b7280';
    }

    setupCharts() {
        this.setupPerformanceChart();
        this.setupTaskDistributionChart();
    }

    setupPerformanceChart() {
        const ctx = document.getElementById('performanceChart');
        if (!ctx) return;

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
                    legend: { position: 'top' }
                }
            }
        });
    }

    setupTaskDistributionChart() {
        const ctx = document.getElementById('taskDistributionChart');
        if (!ctx) return;

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
                    legend: { position: 'bottom' }
                }
            }
        });
    }

    async updateAvailability(availabilityData) {
        try {
            const response = await fetch('/api/technician/availability', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(availabilityData)
            });
            
            if (response.ok) {
                this.showNotification('Availability updated successfully');
                return await response.json();
            } else {
                throw new Error('Failed to update availability');
            }
        } catch (error) {
            console.error('Error updating availability:', error);
            this.showNotification('Failed to update availability', 'danger');
        }
    }

    async updateStatus(status) {
        try {
            const response = await fetch('/api/technician/status', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status })
            });
            
            if (response.ok) {
                this.showNotification(`Status updated to ${status}`);
                return await response.json();
            } else {
                throw new Error('Failed to update status');
            }
        } catch (error) {
            console.error('Error updating status:', error);
            this.showNotification('Failed to update status', 'danger');
        }
    }

    showNotification(message, type = 'success') {
        const dashboard = window.dashboardManager;
        if (dashboard) {
            dashboard.showNotification(message, type);
        }
    }
}

// Initialize dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.dashboardManager = new DashboardManager();
    window.dashboardManager.init();
    
    // Initialize other managers
    window.energyAuditManager = new EnergyAuditManager();
    window.maintenanceManager = new MaintenanceManager();
    window.technicianDashboard = new TechnicianDashboard();
});

// Cleanup on page unload
window.addEventListener('beforeunload', function() {
    if (window.dashboardManager) {
        window.dashboardManager.destroy();
    }
});
