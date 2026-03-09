<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = auth()->user()->orders()->latest()->get();
        return view('adminpanal.order.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $carts = auth()->user()->carts()->whereNull('order_id')->get();
        return view('adminpanal.order.invoice',/* compact('carts')*/);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cart_id' => 'required|exists:carts,id',
        ]);
        $cart = auth()->user()->carts()->findOrFail($validated['cart_id']);
        $order = $cart->orders()->create([
            'user_id' => auth()->id(),
            'total_price' => $cart->total_price,
        ]);
        $cart->items()->update(['order_id' => $order->id]);
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $order = auth()->user()->orders()->findOrFail($id);
        return view('adminpanal.order.orderDetails' /*, compact('order')*/);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
