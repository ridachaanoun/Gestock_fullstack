<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SupplierController extends Controller
{
    public function index()
    {
        if (! Gate::allows('viewAny', Supplier::class)) {
            abort(403);
        }
        return Supplier::paginate(15);
    }

    public function store(Request $request)
    {
        if (! Gate::allows('create', Supplier::class)) {
            abort(403);
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'required|string',
        ]);

        return Supplier::create($validated);
    }

    public function show(Supplier $supplier)
    {
        if (! Gate::allows('view', $supplier)) {
            abort(403);
        }
        return $supplier;
    }

    public function update(Request $request, Supplier $supplier)
    {
        if (! Gate::allows('update', $supplier)) {
            abort(403);
        }
        
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'contact_info' => 'sometimes|string',
        ]);

        $supplier->update($validated);
        return $supplier;
    }

    public function destroy(Supplier $supplier)
    {
        if (! Gate::allows('delete', $supplier)) {
            abort(403);
        }
        $supplier->delete();
        return response()->noContent();
    }
}