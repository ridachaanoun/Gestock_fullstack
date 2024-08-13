<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InventoryController extends Controller
{
    public function index()
    {
        if (! Gate::allows('viewAny', Inventory::class)) {
            abort(403);
        }
        return Inventory::with('products')->paginate(15);
    }

    public function store(Request $request)
    {
        if (! Gate::allows('create', Inventory::class)) {
            abort(403);
        }
        
        $validated = $request->validate([
            'location' => 'required|string',
            'capacity' => 'required|integer',
            'current_stock' => 'required|integer',
        ]);

        return Inventory::create($validated);
    }

    public function show(Inventory $inventory)
    {
        if (! Gate::allows('view', $inventory)) {
            abort(403);
        }
        return $inventory->load('products');
    }

    public function update(Request $request, Inventory $inventory)
    {
        if (! Gate::allows('update', $inventory)) {
            abort(403);
        }
        
        $validated = $request->validate([
            'location' => 'sometimes|string',
            'capacity' => 'sometimes|integer',
            'current_stock' => 'sometimes|integer',
        ]);

        $inventory->update($validated);
        return $inventory;
    }

    public function destroy(Inventory $inventory)
    {
        if (! Gate::allows('delete', $inventory)) {
            abort(403);
        }
        $inventory->delete();
        return response()->noContent();
    }

    public function addProduct(Request $request, Inventory $inventory)
    {
        if (! Gate::allows('update', $inventory)) {
            abort(403);
        }

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $inventory->products()->attach($validated['product_id'], ['quantity' => $validated['quantity']]);
        return $inventory->load('products');
    }

    public function removeProduct(Request $request, Inventory $inventory)
    {
        if (! Gate::allows('update', $inventory)) {
            abort(403);
        }

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $inventory->products()->detach($validated['product_id']);
        return $inventory->load('products');
    }
}