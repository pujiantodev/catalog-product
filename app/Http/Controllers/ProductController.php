<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function  index(Request $request): View
    {
        $products = Product::query()
            ->with(['defaultVariant', 'category', 'brand'])
            ->latest()
            ->simplePaginate(5)
            ->withQueryString();

        return view('product.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('product.create');
    }

    /**
     * todo : store product
     */
    public function store(Request $request)
    {
        $request->validate([]);
    }
}
