@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="display-6 fw-bold mb-4">My Orders</h1>
            
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-box" style="font-size: 4rem; color: #ccc;"></i>
                    <h4 class="mt-3">No orders yet</h4>
                    <p class="text-muted">Your order history will appear here</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">
                        <i class="bi bi-shop me-2"></i>Start Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
