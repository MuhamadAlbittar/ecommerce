<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        return view('store.cart', compact('cart', 'total'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->sale_price ?? $product->price,
                'image' => $product->image,
                'qty' => 1,
            ];
        }

        session()->put('cart', $cart);
        session()->put('cart_count', array_sum(array_column($cart, 'qty')));

        return back()->with('success', 'تمت إضافة المنتج للسلة');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);
        session()->put('cart_count', array_sum(array_column($cart, 'qty')));

        return back()->with('success', 'تم حذف المنتج من السلة');
    }

    public function clear()
    {
        session()->forget('cart');
        session()->forget('cart_count');

        return back()->with('success', 'تم تفريغ السلة');
    }
}