@extends('layouts.app')

@section('content')
<!-- Solar Installation Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">Solar Installation Services</h1>
                <p class="lead mb-4">Transform your property with professional solar panel installation. Save money and reduce your carbon footprint.</p>
                <a href="#get-quote" class="btn btn-light btn-lg">
                    <i class="bi bi-sun me-2"></i>Get Free Solar Quote
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Why Go Solar -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="display-6 fw-bold mb-4">Why Choose Solar Power?</h2>
                <p class="lead mb-4">Solar energy is the future of sustainable living. Here's why thousands of homeowners are making the switch.</p>
                
                <div class="row g-3">
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <div class="icon-container icon-green me-3">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Save Money</h6>
                                <p class="text-muted small mb-0">Reduce your electricity bills by up to 90%</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <div class="icon-container icon-blue me-3">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Energy Independence</h6>
                                <p class="text-muted small mb-0">Protect yourself from rising energy costs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <div class="icon-container icon-yellow me-3">
                                <i class="bi bi-heart"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Environmental Impact</h6>
                                <p class="text-muted small mb-0">Reduce your carbon footprint significantly</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <div class="icon-container icon-orange me-3">
                                <i class="bi bi-graph-up"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Increase Property Value</h6>
                                <p class="text-muted small mb-0">Solar panels increase home value by 4-6%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body text-center p-5">
                        <i class="bi bi-sun" style="font-size: 6rem; color: var(--warning-color);"></i>
                        <h4 class="mt-3">Professional Installation</h4>
                        <p class="text-muted">Our certified installers ensure your solar system is installed safely and efficiently.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Installation Process -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Our Installation Process</h2>
            <p class="lead text-muted">From consultation to completion, we handle everything</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="icon-container icon-green mx-auto mb-3">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <h5>1. Consultation</h5>
                        <p class="text-muted">Free consultation to assess your energy needs and roof suitability.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="icon-container icon-blue mx-auto mb-3">
                            <i class="bi bi-clipboard-check"></i>
                        </div>
                        <h5>2. Design</h5>
                        <p class="text-muted">Custom solar system design optimized for your property and energy goals.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="icon-container icon-yellow mx-auto mb-3">
                            <i class="bi bi-hammer"></i>
                        </div>
                        <h5>3. Installation</h5>
                        <p class="text-muted">Professional installation by certified technicians with quality guarantee.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="icon-container icon-orange mx-auto mb-3">
                            <i class="bi bi-lightning-charge"></i>
                        </div>
                        <h5>4. Activation</h5>
                        <p class="text-muted">System activation, monitoring setup, and ongoing maintenance support.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Get Quote Form -->
<section id="get-quote" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h2 class="display-6 fw-bold">Get Your Free Solar Quote</h2>
                            <p class="lead text-muted">Discover how much you can save with solar power</p>
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
                                    <label for="monthlyBill" class="form-label">Monthly Electricity Bill</label>
                                    <select class="form-select" id="monthlyBill" required>
                                        <option value="">Select range</option>
                                        <option value="0-50">$0 - $50</option>
                                        <option value="50-100">$50 - $100</option>
                                        <option value="100-200">$100 - $200</option>
                                        <option value="200-300">$200 - $300</option>
                                        <option value="300+">$300+</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="roofType" class="form-label">Roof Type</label>
                                    <select class="form-select" id="roofType" required>
                                        <option value="">Select roof type</option>
                                        <option value="asphalt">Asphalt Shingles</option>
                                        <option value="tile">Tile</option>
                                        <option value="metal">Metal</option>
                                        <option value="flat">Flat</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="roofAge" class="form-label">Roof Age</label>
                                    <select class="form-select" id="roofAge" required>
                                        <option value="">Select roof age</option>
                                        <option value="0-5">0-5 years</option>
                                        <option value="5-10">5-10 years</option>
                                        <option value="10-15">10-15 years</option>
                                        <option value="15+">15+ years</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="preferredDate" class="form-label">Preferred Consultation Date</label>
                                    <input type="date" class="form-control" id="preferredDate" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="goals" class="form-label">What are your energy goals?</label>
                                <textarea class="form-control" id="goals" rows="3" placeholder="Tell us about your energy goals, concerns, or specific requirements..."></textarea>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-sun me-2"></i>Get Free Solar Quote
                                </button>
                                <p class="text-muted mt-3 small">
                                    <i class="bi bi-shield-check me-1"></i>
                                    No obligation, completely free consultation and quote.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Solar Benefits -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Solar Power Benefits</h2>
            <p class="lead">Why thousands choose solar with BabiEnergies</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center">
                    <i class="bi bi-currency-dollar" style="font-size: 3rem;"></i>
                    <h5 class="mt-3">Save Money</h5>
                    <p>Average savings of $1,500+ per year on electricity bills.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <i class="bi bi-award" style="font-size: 3rem;"></i>
                    <h5 class="mt-3">25-Year Warranty</h5>
                    <p>Comprehensive warranty coverage on all solar equipment.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <i class="bi bi-tools" style="font-size: 3rem;"></i>
                    <h5 class="mt-3">Maintenance Included</h5>
                    <p>Ongoing maintenance and monitoring services included.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
