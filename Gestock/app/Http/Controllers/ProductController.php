<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index()
    {
        if (! Gate::allows('viewAny', Product::class)) {
            abort(403);
        }
        return Product::paginate(15);
    }

    public function store(Request $request)
    {
        if (! Gate::allows('create', Product::class)) {
            abort(403);
        }
        
        $validated = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        return Product::create($validated);
    }

    public function show(Product $product)
    {
        if (! Gate::allows('view', $product)) {
            abort(403);
        }
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        if (! Gate::allows('update', $product)) {
            abort(403);
        }
        
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'category_id' => 'sometimes|exists:categories,id',
            'supplier_id' => 'sometimes|exists:suppliers,id',
            'quantity' => 'sometimes|integer',
            'price' => 'sometimes|numeric',
        ]);

        $product->update($validated);
        return $product;
    }

    public function destroy(Product $product)
    {
        if (! Gate::allows('delete', $product)) {
            abort(403);
        }
        $product->delete();
        return response()->noContent();
    }
}