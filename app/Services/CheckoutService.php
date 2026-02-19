<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\OrderVendor;
use App\Models\VendorProduct;
use Illuminate\Support\Facades\DB;

class CheckoutService
{
    public function placeOrder(Cart $cart, int $paymentMethodId): Order
    {
        return DB::transaction(function () use ($cart, $paymentMethodId) {

            $items = $cart->cartItems()->with('product', 'vendor')->get();

            if ($items->isEmpty()) {
                throw new \Exception('السلة فارغة، لا يمكن إتمام الطلب');
            }

            $totalPrice = $items->sum(
                fn($item) => $item->price_at_time * $item->quantity
            );

            $order = Order::create([
                'user_id'     => $cart->user_id,
                'cart_id'     => $cart->id,
                'total_price' => $totalPrice,
                'status'      => 'pending',
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id'      => $order->id,
                    'product_id'    => $item->product_id,
                    'vendor_id'     => $item->vendor_id,
                    'quantity'      => $item->quantity,
                    'price_at_time' => $item->price_at_time,
                ]);
            }

            $groupedByVendor = $items->groupBy('vendor_id');

            foreach ($groupedByVendor as $vendorId => $vendorItems) {

                OrderVendor::create([
                    'order_id'    => $order->id,
                    'vendor_id'   => $vendorId,
                    'total_price' => $vendorItems->sum(
                        fn($i) => $i->price_at_time * $i->quantity
                    ),
                    'total_items' => $vendorItems->sum('quantity'),
                ]);

                foreach ($vendorItems as $item) {
                    VendorProduct::where('vendor_id', $vendorId)
                        ->where('product_id', $item->product_id)
                        ->decrement('quantity', $item->quantity);
                }
            }

            OrderPayment::create([
                'order_id'          => $order->id,
                'payment_method_id' => $paymentMethodId,
                'amount'            => $totalPrice,
                'status'            => 'pending',
            ]);

            $cart->update(['status' => 'converted']);

            return $order;
        });
    }
}
