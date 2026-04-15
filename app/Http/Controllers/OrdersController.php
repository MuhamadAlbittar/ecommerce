<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\UserAddress;
use App\Models\ShippingMethod;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->get();
        // dd($orders->pluck('invoice_no', 'customer_name', 'method', 'amount', 'order_time'  ));
        return view('adminpanal.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function Invoice()
    // {
    //     // $carts = auth()->user()->carts()->whereNull('order_id')->get();
    //     return view('adminpanal.order.invoice',/* compact('carts')*/);
    // }
    public function Invoice($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);

        return view('adminPanal.order.invoice', compact('order'));
    }

    public function create()
    {
        //
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
    public function show($id)
    {
        $order = Order::with([
            'orderItems.product',
            'shippingMethod',
            'UserAddress',
            'payments'
        ])->findOrFail($id);
        $orderItems = $order->orderItems()->with('product')->get();
        $orderShippingAddress = $order->UserAddress;
        $orderPaymentMethod = $order->payments()->first();
        return view('adminPanal.order.orderDetails', compact('order', 'orderItems', 'orderShippingAddress', 'orderPaymentMethod'));
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
    public function track(Request $request)
{
    $order = null;
    $error = null;

    if ($request->filled('order_id')) {
        $order = \App\Models\Order::with([
            'orderItems.product',
            'orderShipments.shippingMethod',
            'orderVendors',
        ])->where('id', $request->order_id)
          ->where('user_id', auth()->id())
          ->first();

        if (!$order) {
            $error = 'Order not found. Please check the order number.';
        }
    }

    return view('store.tracking', compact('order', 'error'));
}
    // public function updateStatus(Request $request, Order $order)
    // {
    //     $request->validate([
    //         'status' => 'required|string'
    //     ]);

    //     $order->status = $request->status;
    //     $order->save();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Status updated successfully'
    //     ]);
    // }طريقة AJAX
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status updated successfully');
    }


}
