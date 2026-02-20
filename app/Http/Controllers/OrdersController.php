<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\Order\UpdateOrderStatusRequest;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * قائمة الطلبات مع بحث وفلترة وإحصائيات
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'orderItems', 'payments'])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                  ->orWhereHas('user', function ($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $orders          = $query->paginate(15)->withQueryString();
        $totalOrders     = Order::count();
        $pendingOrders   = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();

        return view('adminPanal.orders.index', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'completedOrders'
        ));
    }

    /**
     * تفاصيل طلب واحد — eager loading لمنع N+1
     */
    public function show(string $id)
    {
        $order = Order::with([
            'user',
            'orderItems.product',
            'orderItems.vendor',
            'orderVendors.vendor',
            'payments.paymentMethod',
        ])->findOrFail($id);

        return view('adminPanal.orders.show', compact('order'));
    }

    /**
     * تحديث حالة الطلب
     */
    public function update(UpdateOrderStatusRequest $request, string $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()
            ->route('orders.show', $order->id)
            ->with('success', 'تم تحديث حالة الطلب إلى: ' . ($request->status === 'completed' ? 'مكتمل' : 'معلق'));
    }

    /**
     * عرض فاتورة الطلب للطباعة
     */
    public function invoice(string $id)
    {
        $order = Order::with([
            'user',
            'orderItems.product',
            'orderItems.vendor',
            'orderVendors.vendor',
            'payments.paymentMethod',
        ])->findOrFail($id);

        return view('adminPanal.orders.invoice', compact('order'));
    }
}
