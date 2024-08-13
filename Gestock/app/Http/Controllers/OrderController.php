<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function index()
    {
        if (! Gate::allows('viewAny', Order::class)) {
            abort(403);
        }
        return Order::with('orderItems')->paginate(15);
    }

    public function store(Request $request)
    {
        if (! Gate::allows('create', Order::class)) {
            abort(403);
        }
        
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_price' => 'required|numeric',
            'status' => 'required|string',
            'order_items' => 'required|array',
            'order_items.*.product_id' => 'required|exists:products,id',
            'order_items.*.quantity' => 'required|integer',
            'order_items.*.price' => 'required|numeric',
        ]);

        $order = Order::create([
            'customer_id' => $validated['customer_id'],
            'user_id' => $request->user()->id,
            'total_price' => $validated['total_price'],
            'status' => $validated['status'],
        ]);

        foreach ($validated['order_items'] as $item) {
            $order->orderItems()->create($item);
        }

        return $order->load('orderItems');
    }

    public function show(Order $order)
    {
        if (! Gate::allows('view', $order)) {
            abort(403);
        }
        return $order->load('orderItems');
    }

    public function update(Request $request, Order $order)
{
    if (! Gate::allows('update', $order)) {
        abort(403);
    }

    $validated = $request->validate([
        'customer_id' => 'sometimes|exists:customers,id',
        'user_id' => 'sometimes|exists:users,id',
        'total_price' => 'sometimes|numeric',
        'status' => 'sometimes|string',
    ]);

    $order->update($validated);

    return $order->load('orderItems');
}


    public function destroy(Order $order)
    {
        if (! Gate::allows('delete', $order)) {
            abort(403);
        }
        $order->delete();
        return response()->noContent();
    }
}