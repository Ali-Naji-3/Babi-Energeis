@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="display-6 fw-bold mb-4">Order Details</h1>
            
            <div class="card">
                <div class="card-body">
                    <h4>Order #{{ $order->order_number ?? 'N/A' }}</h4>
                    <p class="text-muted">Order details will be displayed here</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
