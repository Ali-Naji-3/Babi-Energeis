<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Product::where('is_active', true);
            
            // Filter by category
            if ($request->has('category') && $request->category) {
                $query->where('category_id', $request->category);
            }
            
            // Search
            if ($request->has('search') && $request->search) {
                $query->where(function($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');
                });
            }
            
            // Sort
            $sort = $request->get('sort', 'name');
            $direction = $request->get('direction', 'asc');
            
            switch ($sort) {
                case 'price':
                    $query->orderBy('price', $direction);
                    break;
                case 'name':
                default:
                    $query->orderBy('name', $direction);
                    break;
            }
            
            $products = $query->paginate(12);
            $categories = Category::where('is_active', true)->get();
            
            return view('products.index', compact('products', 'categories'));
        } catch (\Exception $e) {
            // If database is not ready, show empty products page
            $products = collect();
            $categories = collect();
            return view('products.index', compact('products', 'categories'));
        }
    }
    
    public function show(Product $product)
    {
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();
            
        return view('products.show', compact('product', 'relatedProducts'));
    }
}