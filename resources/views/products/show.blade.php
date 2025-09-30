@extends('layouts.app')

@section('content')
<!-- Product Detail Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        @if($product->images && count($product->images) > 0)
                            <!-- Main Image Display -->
                            <div class="text-center mb-3">
                                <img id="mainImage" 
                                     src="{{ Storage::url($product->images[0]) }}" 
                                     alt="{{ $product->name }}" 
                                     class="img-fluid rounded" 
                                     style="max-height: 400px; object-fit: contain;">
                            </div>
                            
                            <!-- Thumbnail Gallery -->
                            @if(count($product->images) > 1)
                                <div class="d-flex gap-2 justify-content-center flex-wrap">
                                    @foreach($product->images as $index => $image)
                                        <img src="{{ Storage::url($image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-thumbnail" 
                                             style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                                             onclick="changeMainImage('{{ Storage::url($image) }}', this)">
                                    @endforeach
                                </div>
                            @endif
                        @else
                            <!-- Fallback Icon -->
                            <div class="text-center">
                                <i class="bi bi-solar-panel" style="font-size: 8rem; color: var(--primary-color);"></i>
                            </div>
                        @endif
                        
                        <h2 class="mt-3 text-center">{{ $product->name }}</h2>
                        <p class="text-muted text-center">{{ $product->short_description ?? $product->description }}</p>
                        
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
                                @foreach($product->features ?? [] as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        @endif
                        
                        @if($product->specifications)
                            <h5>Specifications</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    @foreach($product->specifications ?? [] as $key => $value)
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
                            @if($relatedProduct->images && count($relatedProduct->images) > 0)
                                <img src="{{ Storage::url($relatedProduct->images[0]) }}" 
                                     alt="{{ $relatedProduct->name }}" 
                                     class="img-fluid rounded mb-2" 
                                     style="height: 120px; width: 100%; object-fit: contain;">
                            @else
                                <i class="bi bi-solar-panel" style="font-size: 3rem; color: var(--primary-color);"></i>
                            @endif
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

function changeMainImage(imageUrl, thumbnail) {
    // Update main image
    document.getElementById('mainImage').src = imageUrl;
    
    // Update active thumbnail styling
    document.querySelectorAll('.img-thumbnail').forEach(img => {
        img.style.border = '2px solid #dee2e6';
        img.style.opacity = '0.7';
    });
    thumbnail.style.border = '2px solid var(--bs-primary)';
    thumbnail.style.opacity = '1';
}

// Set first thumbnail as active on page load
document.addEventListener('DOMContentLoaded', function() {
    const firstThumbnail = document.querySelector('.img-thumbnail');
    if (firstThumbnail) {
        firstThumbnail.style.border = '2px solid var(--bs-primary)';
        firstThumbnail.style.opacity = '1';
    }
});
</script>
@endsection