<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EnergyAuditController;
use App\Http\Controllers\SolarRequestController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Favicon redirect for old path
Route::get('/images/favicon.ico', function () {
    return redirect('/favicon.ico', 301);
});
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/energy-audit', [EnergyAuditController::class, 'index'])->name('energy-audit');
Route::get('/solar-installation', [SolarRequestController::class, 'index'])->name('solar-installation');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Temporary route for cart count
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
    
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
});

Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    
    // Home redirect for customers
    Route::get('/home', function () {
        return view('dashboard');
    })->name('home');
    
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    
    // Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    
    // Checkout
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    
    // Energy Audit Routes
    Route::get('/energy-audit/create', [EnergyAuditController::class, 'create'])->name('energy-audit.create');
    Route::post('/energy-audit', [EnergyAuditController::class, 'store'])->name('energy-audit.store');
    Route::get('/energy-audit/{audit}', [EnergyAuditController::class, 'show'])->name('energy-audit.show');
    
    // Solar Request Routes
    Route::get('/solar-request/create', [SolarRequestController::class, 'create'])->name('solar-request.create');
    Route::post('/solar-request', [SolarRequestController::class, 'store'])->name('solar-request.store');
    Route::get('/solar-request/{request}', [SolarRequestController::class, 'show'])->name('solar-request.show');
    
    // Maintenance Routes
    Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');
    Route::get('/maintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
    
    // Dashboard API Routes
    Route::get('/api/dashboard/stats', [App\Http\Controllers\DashboardController::class, 'getStats'])->name('dashboard.stats');
    Route::get('/api/dashboard/activity', [App\Http\Controllers\DashboardController::class, 'getRecentActivity'])->name('dashboard.activity');
    
    // Lebanese Energy Services API Routes
    Route::get('/api/energy-audits', [App\Http\Controllers\EnergyAuditController::class, 'index']);
    Route::post('/api/energy-audits', [App\Http\Controllers\EnergyAuditController::class, 'store']);
    Route::get('/api/energy-audits/{audit}', [App\Http\Controllers\EnergyAuditController::class, 'show']);
    Route::put('/api/energy-audits/{audit}/status', [App\Http\Controllers\EnergyAuditController::class, 'updateStatus']);
    Route::put('/api/energy-audits/{audit}/assign-technician', [App\Http\Controllers\EnergyAuditController::class, 'assignTechnician']);
    
    Route::get('/api/maintenance-visits', [App\Http\Controllers\MaintenanceController::class, 'index']);
    Route::post('/api/maintenance-visits', [App\Http\Controllers\MaintenanceController::class, 'store']);
    Route::get('/api/maintenance-visits/upcoming', [App\Http\Controllers\MaintenanceController::class, 'upcoming']);
    Route::put('/api/maintenance-visits/{visit}/status', [App\Http\Controllers\MaintenanceController::class, 'updateStatus']);
    Route::post('/api/maintenance-visits/{visit}/photos', [App\Http\Controllers\MaintenanceController::class, 'addPhotos']);
    Route::post('/api/maintenance-visits/{visit}/parts', [App\Http\Controllers\MaintenanceController::class, 'recordParts']);
    
    Route::get('/api/technicians/lebanon', [App\Http\Controllers\TechnicianController::class, 'lebanon']);
    Route::get('/api/technician/profile', [App\Http\Controllers\TechnicianController::class, 'profile']);
    Route::get('/api/technician/schedule', [App\Http\Controllers\TechnicianController::class, 'schedule']);
    Route::put('/api/technician/availability', [App\Http\Controllers\TechnicianController::class, 'updateAvailability']);
    Route::put('/api/technician/status', [App\Http\Controllers\TechnicianController::class, 'updateStatus']);
    Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/account', [ProfileController::class, 'edit'])->name('account');
});

// Admin Routes (Filament) - Protected by admin role
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Admin routes will be handled by Filament
});