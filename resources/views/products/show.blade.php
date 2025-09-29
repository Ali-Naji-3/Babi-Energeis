@extends('layouts.app')

@section('content')
<!-- Product Detail Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-solar-panel" style="font-size: 8rem; color: var(--primary-color);"></i>
                        <h2 class="mt-3">{{ $product->name }}</h2>
                        <p class="text-muted">{{ $product->short_description ?? $product->description }}</p>
                        
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            @if($product->sale_price)
                                <span class="h3 text-primary me-3">
                                    ${{ number_format($product->sale_price, 2) }}
                                </span>
                                <span class="h5 text-decoration-line-through text-muted">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            @else
                                <span class="h3 text-primary">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-lg" onclick="addToCart({{ $product->id }})">
                                <i class="bi bi-cart-plus me-2"></i>Add to Cart
                            </button>
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-heart me-2"></i>Add to Wishlist
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Product Details</h4>
                        <hr>
                        
                        <div class="mb-3">
                            <strong>SKU:</strong> {{ $product->sku }}
                        </div>
                        
                        <div class="mb-3">
                            <strong>Category:</strong> {{ $product->category->name }}
                        </div>
                        
                        @if($product->weight)
                            <div class="mb-3">
                                <strong>Weight:</strong> {{ $product->weight }} lbs
                            </div>
                        @endif
                        
                        @if($product->dimensions)
                            <div class="mb-3">
                                <strong>Dimensions:</strong> {{ $product->dimensions }}
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <strong>Stock:</strong> 
                            @if($product->stock_quantity > 0)
                                <span class="text-success">{{ $product->stock_quantity }} in stock</span>
                            @else
                                <span class="text-danger">Out of stock</span>
                            @endif
                        </div>
                        
                        <hr>
                        
                        <h5>Description</h5>
                        <p>{{ $product->description }}</p>
                        
                        @if($product->features)
                            <h5>Features</h5>
                            <ul>
                                @foreach(json_decode($product->features, true) ?? [] as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        @endif
                        
                        @if($product->specifications)
                            <h5>Specifications</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    @foreach(json_decode($product->specifications, true) ?? [] as $key => $value)
                                        <tr>
                                            <td><strong>{{ $key }}:</strong></td>
                                            <td>{{ $value }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
@if($relatedProducts->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Related Products</h2>
            <p class="lead text-muted">You might also like these products</p>
        </div>
        
        <div class="row g-4">
            @foreach($relatedProducts as $relatedProduct)
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-solar-panel" style="font-size: 3rem; color: var(--primary-color);"></i>
                            <h5 class="card-title mt-3">{{ $relatedProduct->name }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($relatedProduct->short_description ?? $relatedProduct->description, 80) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="h6 text-primary mb-0">
                                    @if($relatedProduct->sale_price)
                                        <span class="text-decoration-line-through text-muted me-2">${{ number_format($relatedProduct->price, 2) }}</span>
                                        <span>${{ number_format($relatedProduct->sale_price, 2) }}</span>
                                    @else
                                        ${{ number_format($relatedProduct->price, 2) }}
                                    @endif
                                </span>
                            </div>
                            
                            <a href="{{ route('products.show', $relatedProduct) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye me-1"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<script>
function addToCart(productId) {
    // Simple cart functionality - in a real app, this would make an AJAX request
    alert('Product added to cart! (This is a demo)');
}
</script>
@endsection