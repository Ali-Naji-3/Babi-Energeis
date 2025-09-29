@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <h1 class="display-6 fw-bold mb-4">My Profile</h1>
            
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="{{ $user->name ?? '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ $user->email ?? '' }}" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" 
                                       value="{{ $user->phone ?? '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label">Account Type</label>
                                <input type="text" class="form-control" value="{{ ucfirst($user->role ?? 'Customer') }}" readonly>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3">{{ $user->address ?? '' }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Update Profile
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4>Account Information</h4>
                    <hr>
                    <p><strong>Member since:</strong> {{ $user->created_at->format('M Y') ?? 'N/A' }}</p>
                    <p><strong>Account type:</strong> {{ ucfirst($user->role ?? 'Customer') }}</p>
                    <p><strong>Email verified:</strong> {{ $user->email_verified_at ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
