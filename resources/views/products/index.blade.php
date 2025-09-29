@extends('layouts.app')

@section('content')
<!-- Products Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">Our Products</h1>
                <p class="lead mb-4">High-quality energy products for your sustainable home</p>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="py-5">
    <div class="container">
        <!-- Filters -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <form method="GET" action="{{ route('products.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="category" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="sort" class="form-select">
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Sort by Name</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Sort by Price</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Products Grid -->
        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="text-center mb-3">
                                <i class="bi bi-solar-panel" style="font-size: 3rem; color: var(--primary-color);"></i>
                            </div>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($product->short_description ?? $product->description, 100) }}</p>
                            
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="h5 text-primary mb-0">
                                        @if($product->sale_price)
                                            <span class="text-decoration-line-through text-muted me-2">${{ number_format($product->price, 2) }}</span>
                                            <span>${{ number_format($product->sale_price, 2) }}</span>
                                        @else
                                            ${{ number_format($product->price, 2) }}
                                        @endif
                                    </span>
                                    @if($product->sale_price)
                                        <span class="badge bg-danger">Sale</span>
                                    @endif
                                </div>
                                
                                <div class="d-grid gap-2">
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-eye me-1"></i>View Details
                                    </a>
                                    <button class="btn btn-primary" onclick="addToCart({{ $product->id }})">
                                        <i class="bi bi-cart-plus me-1"></i>Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="bi bi-search" style="font-size: 4rem; color: #ccc;"></i>
                        <h4 class="mt-3">No products found</h4>
                        <p class="text-muted">Try adjusting your search criteria</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">View All Products</a>
                    </div>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
            <div class="row mt-5">
                <div class="col-12">
                    {{ $products->links() }}
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Categories Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Product Categories</h2>
            <p class="lead text-muted">Browse products by category</p>
        </div>
        
        <div class="row g-4">
            @foreach($categories->take(6) as $category)
                <div class="col-md-4 col-lg-2">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="bi bi-lightning-charge" style="font-size: 2rem; color: var(--primary-color);"></i>
                            <h6 class="card-title mt-3">{{ $category->name }}</h6>
                            <a href="{{ route('products.index', ['category' => $category->id]) }}" class="btn btn-outline-primary btn-sm">
                                View Products
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
function addToCart(productId) {
    // Simple cart functionality - in a real app, this would make an AJAX request
    alert('Product added to cart! (This is a demo)');
}
</script>
@endsection