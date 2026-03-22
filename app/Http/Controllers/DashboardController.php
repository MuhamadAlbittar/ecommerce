<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Refund;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ---- الأرقام الرئيسية ----
        $todayRevenue = Order::whereDate('created_at', today())
            ->where('status', '!=', 'cancelled')
            ->sum('total_price');

        $todayOrders = Order::whereDate('created_at', today())->count();

        $totalProducts = Product::count();
        $totalVendors  = Vendor::count();
        $totalUsers    = User::count();
        $pendingRefunds = Refund::where('status', 'pending')->count();

        // ---- بيانات الشارت: آخر 7 أيام ----
        $chartLabels  = [];
        $chartRevenue = [];
        $chartOrders  = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chartLabels[]  = $date->format('M d');
            $chartRevenue[] = Order::whereDate('created_at', $date)
                ->where('status', '!=', 'cancelled')
                ->sum('total_price');
            $chartOrders[]  = Order::whereDate('created_at', $date)->count();
        }

        // ---- آخر 5 طلبات ----
        $latestOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        // ---- أكثر المنتجات مبيعاً ----
        $topProducts = Product::withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->take(5)
            ->get();

        return view('adminPanal.index', compact(
            'todayRevenue', 'todayOrders', 'totalProducts',
            'totalVendors', 'totalUsers', 'pendingRefunds',
            'chartLabels', 'chartRevenue', 'chartOrders',
            'latestOrders', 'topProducts'
        ));
    }
}
