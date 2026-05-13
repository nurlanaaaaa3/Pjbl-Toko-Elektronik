<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::with('category')
            ->where('is_active', true)
            ->when($request->category, function($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->when($request->search, function($query) use ($request) {
                $query->where('title', 'like', '%'.$request->search.'%');
            })
            ->get();

        return view('shop.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }
}