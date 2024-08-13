<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    public function index()
    {
        if (! Gate::allows('viewAny', Customer::class)) {
            abort(403);
        }
        return Customer::paginate(15);
    }

    public function store(Request $request)
    {
        if (! Gate::allows('create', Customer::class)) {
            abort(403);
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        return Customer::create($validated);
    }

    public function show(Customer $customer)
    {
        if (! Gate::allows('view', $customer)) {
            abort(403);
        }
        return $customer;
    }

    public function update(Request $request, Customer $customer)
    {
        if (! Gate::allows('update', $customer)) {
            abort(403);
        }
        
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:customers,email,'.$customer->id,
            'phone' => 'sometimes|string',
            'address' => 'sometimes|string',
        ]);

        $customer->update($validated);
        return $customer;
    }

    public function destroy(Customer $customer)
    {
        if (! Gate::allows('delete', $customer)) {
            abort(403);
        }
        $customer->delete();
        return response()->noContent();
    }
}