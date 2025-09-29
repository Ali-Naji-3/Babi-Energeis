@extends('layouts.app')

@section('title', 'Dashboard - BabiEnergies')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Welcome back, {{ Auth::user()->name }}!</h1>
            
            @if(Auth::user()->isAdmin())
                <div class="alert alert-info">
                    <h5><i class="bi bi-shield-check"></i> Admin Access</h5>
                    <p class="mb-0">You have administrative privileges. Access the admin panel <a href="/admin" class="alert-link">here</a>.</p>
                </div>
            @else
                <div class="alert alert-success">
                    <h5><i class="bi bi-person-check"></i> Customer Dashboard</h5>
                    <p class="mb-0">Welcome to your customer dashboard. Manage your orders, energy audits, and solar installations.</p>
                </div>
            @endif
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-box-seam feature-icon text-primary"></i>
                    <h5 class="card-title">Orders</h5>
                    <p class="card-text">View and track your orders</p>
                    <a href="{{ route('orders.index') }}" class="btn btn-primary">View Orders</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-clipboard-data feature-icon text-success"></i>
                    <h5 class="card-title">Energy Audit</h5>
                    <p class="card-text">Book an energy audit</p>
                    <a href="{{ route('energy-audit.create') }}" class="btn btn-success">Book Audit</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-sun feature-icon text-warning"></i>
                    <h5 class="card-title">Solar Installation</h5>
                    <p class="card-text">Request solar installation</p>
                    <a href="{{ route('solar-request.create') }}" class="btn btn-warning">Get Quote</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-tools feature-icon text-info"></i>
                    <h5 class="card-title">Maintenance</h5>
                    <p class="card-text">Schedule maintenance</p>
                    <a href="{{ route('maintenance.index') }}" class="btn btn-info">Schedule</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Account Management</h6>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('profile.edit') }}" class="text-decoration-none"><i class="bi bi-person"></i> Update Profile</a></li>
                                <li><a href="{{ route('cart.index') }}" class="text-decoration-none"><i class="bi bi-cart"></i> Shopping Cart</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Services</h6>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('products.index') }}" class="text-decoration-none"><i class="bi bi-grid"></i> Browse Products</a></li>
                                <li><a href="#" class="text-decoration-none"><i class="bi bi-headset"></i> Contact Support</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
