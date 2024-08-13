<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderItemController extends Controller
{
    public function index()
    {
        if (! Gate::allows('viewAny', OrderItem::class)) {
            abort(403);
        }
        return OrderItem::paginate(15);
    }

    public function store(Request $request)
    {
        if (! Gate::allows('create', OrderItem::class)) {
            abort(403);
        }
        
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
        ]);

        return OrderItem::create($validated);
    }

    public function show(OrderItem $orderItem)
    {
        if (! Gate::allows('view', $orderItem)) {
            abort(403);
        }
        return $orderItem;
    }

    public function update(Request $request, OrderItem $orderItem)
    {
        if (! Gate::allows('update', $orderItem)) {
            abort(403);
        }
    
        $validated = $request->validate([
            'order_id' => 'sometimes|exists:orders,id',
            'product_id' => 'sometimes|exists:products,id',
            'quantity' => 'sometimes|integer|min:1',
            'price' => 'sometimes|numeric',
        ]);
    
        $orderItem->update($validated);
    
        return $orderItem;
    }
    
    

    public function destroy(OrderItem $orderItem)
    {
        if (! Gate::allows('delete', $orderItem)) {
            abort(403);
        }
        $orderItem->delete();
        return response()->noContent();
    }
}
