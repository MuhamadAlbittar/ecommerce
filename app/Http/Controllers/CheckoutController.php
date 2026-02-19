<?php

namespace App\Http\Controllers;

use App\Http\Requests\Checkout\PlaceOrderRequest;
use App\Models\PaymentMethod;
use App\Services\CheckoutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(
        private CheckoutService $checkoutService
    ) {}

    public function index(Request $request)
    {
        $cart = $request->user()
            ->activeCart()
            ->with('cartItems.product', 'cartItems.vendor')
            ->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('dashboard')
                ->with('error', 'سلة التسوق فارغة');
        }

        $paymentMethods = PaymentMethod::where('is_active', true)->get();

        return view('checkout.index', compact('cart', 'paymentMethods'));
    }

    public function store(PlaceOrderRequest $request): RedirectResponse
    {
        $cart = $request->user()->activeCart()->first();

        if (!$cart) {
            return redirect()->back()
                ->with('error', 'لا توجد سلة نشطة');
        }

        try {
            $order = $this->checkoutService->placeOrder(
                $cart,
                $request->payment_method_id
            );

            return redirect()
                ->route('orders.show', $order->id)
                ->with('success', 'تم إنشاء طلبك بنجاح! رقم الطلب: #' . $order->id);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'فشل إنشاء الطلب: ' . $e->getMessage());
        }
    }
}
