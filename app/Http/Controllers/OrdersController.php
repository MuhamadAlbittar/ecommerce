<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * 1. عرض قائمة الطلبات (للأدمن)
     */
    public function index()
    {
        // جلب جميع الطلبات مع المستخدمين لعرضها في لوحة التحكم
        $orders = Order::with('user')->latest()->get();
        return view('adminPanal.order.index', compact('orders'));
    }

    /**
     * 2. إنشاء طلب جديد (عملية الشراء - Checkout)
     * هذا هو الكود الصحيح والآمن لتحويل السلة إلى طلب
     */
    public function store(Request $request)
    {
        // 1. التحقق من العنوان
        $request->validate([
            'address_id' => 'required|exists:user_addresses,id',
        ]);

        $user = auth()->user();

        // 2. جلب السلة مع العناصر والمنتجات
        $cart = Cart::with('items.product')->where('user_id', $user->id)->first();

        // التحقق من وجود سلة وبداخلها منتجات
        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'سلتك فارغة!');
        }

        // 3. بدء المعاملة (Transaction) لضمان سلامة البيانات
        DB::beginTransaction();
        try {
            $total = 0;

            // حساب المجموع الكلي
            foreach ($cart->items as $item) {
                $price = $item->product->sale_price ?? $item->product->price;
                $total += $price * $item->quantity;
            }

            // 4. إنشاء الطلب الرئيسي
            $order = Order::create([
                'user_id' => $user->id,
                'user_address_id' => $request->address_id,
                'total' => $total,
                'status' => 'pending',
                'payment_status' => 'pending',
            ]);

            // 5. نقل العناصر من السلة إلى عناصر الطلب وتحديث المخزون
            foreach ($cart->items as $item) {
                $price = $item->product->sale_price ?? $item->product->price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'qty' => $item->quantity,
                    'unit_price' => $price,
                    'total' => $price * $item->quantity,
                ]);

                // خصم الكمية من المخزون
                $item->product->decrement('quantity', $item->quantity);
            }

            // 6. حذف السلة بعد نجاح العملية
            $cart->items()->delete();
            $cart->delete();

            DB::commit(); // تأكيد الحفظ النهائي

            return redirect()->route('orders.confirmation', $order->id)
                             ->with('success', 'تم الطلب بنجاح!');

        } catch (\Exception $e) {
            DB::rollBack(); // التراجع عن كل شيء عند حدوث خطأ
            return back()->with('error', 'حدث خطأ أثناء المعالجة: ' . $e->getMessage());
        }
    }

    /**
     * 3. صفحة تأكيد الطلب (للمستخدم)
     */
    public function confirmation($id)
    {
        $order = Order::with('items.product')->where('user_id', auth()->id())->findOrFail($id);
        return view('store.confirmation', compact('order'));
    }

    /**
     * 4. طباعة الفاتورة (للأدمن)
     */
    public function Invoice($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('adminPanal.order.invoice', compact('order'));
    }

    /**
     * 5. تتبع الطلب (للمستخدم)
     */
    public function track(Request $request)
    {
        $order = null;
        $error = null;

        if ($request->filled('order_id')) {
            // البحث عن الطلب الخاص بالمستخدم فقط
            $order = Order::with(['items.product', 'orderShipments'])
                        ->where('id', $request->order_id)
                        ->where('user_id', auth()->id())
                        ->first();

            if (!$order) {
                $error = 'لم يتم العثور على الطلب، تأكد من الرقم.';
            }
        }

        return view('store.tracking', compact('order', 'error'));
    }

    /**
     * 6. تحديث حالة الطلب (للأدمن)
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح');
    }

    /**
     * 7. عرض تفاصيل الطلب (للأدمن)
     */
    public function show(string $id)
    {
        $order = Order::with('items.product', 'user')->findOrFail($id);
        return view('adminPanal.order.orderDetails', compact('order'));
    }
}
