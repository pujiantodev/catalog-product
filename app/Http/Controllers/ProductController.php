<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * setiap satu produk pasti punya satu variant sebagai default
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => ['required', 'max:200'],
            'sku'   => ['required', 'max:32'],
            'stock' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'weight' => ['required', 'integer']
        ]);

        DB::transaction(function () use ($request) {
            // create product, slug otomatis by trait model
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'brand_id' => $request->brand,
                'category_id' => $request->category,
                'status' => $request->status ?? Product::STATUS_PUBLISH
            ]);
            // create default variant of product
            ProductVariant::create([
                'product_id' => $product->id,
                'sku' => $request->sku,
                'price' => $request->price,
                'stock' => $request->stock,
                'weight' => $request->weight,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
                'is_default' => true,
            ]);
        }, 5);
        return to_route('products.index')->with('status', "Berhasil membuat produk baru.");
    }

    public function show($id)
    {
        $product = Product::query()
            ->with(['defaultVariant', 'category', 'brand'])
            ->findOrFail($id);

        return view('product.show', [
            'product' => $product
        ]);
    }
    public function edit($id)
    {
        $product = Product::query()
            ->with(['defaultVariant', 'category', 'brand'])
            ->findOrFail($id);

        return view('product.edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => ['required', 'max:200'],
            'sku'   => ['required', 'max:32'],
            'stock' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'weight' => ['required', 'integer']
        ]);


        DB::transaction(function () use ($request, $id) {
            $product = Product::findOrFail($id);
            // update product
            $product->update([
                'name' => $request->name,
                'description' => $request->description ?? null,
                'brand_id' => $request->brand ?? null,
                'category_id' => $request->category ?? null,
                'status' => $request->status ?? Product::STATUS_PUBLISH
            ]);
            // update default variant of product
            $product->defaultVariant->update([
                'product_id' => $product->id,
                'sku' => $request->sku,
                'price' => $request->price,
                'stock' => $request->stock,
                'weight' => $request->weight,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
                'is_default' => true,
            ]);
        }, 5);
        return back()->with('status', "Berhasil update produk");
    }
}
