@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="display-6 fw-bold mb-4">Shopping Cart</h1>
            
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-cart" style="font-size: 4rem; color: #ccc;"></i>
                    <h4 class="mt-3">Your cart is empty</h4>
                    <p class="text-muted">Add some products to get started</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">
                        <i class="bi bi-shop me-2"></i>Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection