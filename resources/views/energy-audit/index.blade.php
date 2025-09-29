
    @extends('layouts.app')

@section('content')
<!-- Energy Audit Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">Energy Audit Services</h1>
                <p class="lead mb-4">Discover how much you can save with a professional energy audit. Get personalized recommendations to reduce your energy costs.</p>
                <a href="#book-audit" class="btn btn-light btn-lg">
                    <i class="bi bi-clipboard-check me-2"></i>Book Free Energy Audit
                </a>
            </div>
        </div>
    </div>
</section>

<!-- What is Energy Audit -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="display-6 fw-bold mb-4">What is an Energy Audit?</h2>
                <p class="lead mb-4">A comprehensive assessment of your property's energy usage to identify opportunities for improvement and cost savings.</p>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="icon-container icon-green me-3">
                                <i class="bi bi-search"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Energy Analysis</h6>
                                <p class="text-muted small mb-0">Detailed energy usage analysis</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="icon-container icon-blue me-3">
                                <i class="bi bi-lightbulb"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Efficiency Tips</h6>
                                <p class="text-muted small mb-0">Personalized recommendations</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="icon-container icon-yellow me-3">
                                <i class="bi bi-calculator"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Savings Calculator</h6>
                                <p class="text-muted small mb-0">Potential cost savings</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="icon-container icon-orange me-3">
                                <i class="bi bi-file-text"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Detailed Report</h6>
                                <p class="text-muted small mb-0">Comprehensive audit report</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body text-center p-5">
                        <i class="bi bi-house-check" style="font-size: 6rem; color: var(--primary-color);"></i>
                        <h4 class="mt-3">Professional Assessment</h4>
                        <p class="text-muted">Our certified technicians will thoroughly evaluate your property's energy efficiency.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Audit Process -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Our Audit Process</h2>
            <p class="lead text-muted">Simple, professional, and thorough</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="icon-container icon-green mx-auto mb-3">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h5>1. Schedule</h5>
                        <p class="text-muted">Book your free energy audit appointment at your convenience.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="icon-container icon-blue mx-auto mb-3">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <h5>2. Assessment</h5>
                        <p class="text-muted">Our certified technician conducts a thorough property evaluation.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="icon-container icon-yellow mx-auto mb-3">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h5>3. Analysis</h5>
                        <p class="text-muted">We analyze your energy usage and identify improvement opportunities.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="icon-container icon-orange mx-auto mb-3">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <h5>4. Report</h5>
                        <p class="text-muted">Receive a detailed report with recommendations and savings estimates.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Book Audit Form -->
<section id="book-audit" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h2 class="display-6 fw-bold">Book Your Free Energy Audit</h2>
                            <p class="lead text-muted">Get started with your energy savings journey today</p>
                        </div>
                        
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Property Address</label>
                                <textarea class="form-control" id="address" rows="2" required></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="propertyType" class="form-label">Property Type</label>
                                    <select class="form-select" id="propertyType" required>
                                        <option value="">Select property type</option>
                                        <option value="residential">Residential</option>
                                        <option value="commercial">Commercial</option>
                                        <option value="industrial">Industrial</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="propertySize" class="form-label">Property Size (sq ft)</label>
                                    <input type="number" class="form-control" id="propertySize" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="preferredDate" class="form-label">Preferred Date</label>
                                    <input type="date" class="form-control" id="preferredDate" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="preferredTime" class="form-label">Preferred Time</label>
                                    <select class="form-select" id="preferredTime" required>
                                        <option value="">Select time</option>
                                        <option value="morning">Morning (8 AM - 12 PM)</option>
                                        <option value="afternoon">Afternoon (12 PM - 5 PM)</option>
                                        <option value="evening">Evening (5 PM - 8 PM)</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="notes" class="form-label">Additional Notes</label>
                                <textarea class="form-control" id="notes" rows="3" placeholder="Tell us about your energy concerns or specific areas you'd like us to focus on..."></textarea>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-calendar-check me-2"></i>Book Free Energy Audit
                                </button>
                                <p class="text-muted mt-3 small">
                                    <i class="bi bi-shield-check me-1"></i>
                                    Your information is secure and will only be used to schedule your audit.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Why Choose Our Energy Audits?</h2>
            <p class="lead">Professional, thorough, and results-driven</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center">
                    <i class="bi bi-award" style="font-size: 3rem;"></i>
                    <h5 class="mt-3">Certified Technicians</h5>
                    <p>Our team consists of certified energy auditors with years of experience.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <i class="bi bi-graph-up" style="font-size: 3rem;"></i>
                    <h5 class="mt-3">Proven Results</h5>
                    <p>Our clients save an average of 20-30% on their energy bills.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <i class="bi bi-clock" style="font-size: 3rem;"></i>
                    <h5 class="mt-3">Quick Turnaround</h5>
                    <p>Receive your detailed audit report within 48 hours.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
