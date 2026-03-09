<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartItemsController extends Controller
{
    // إضافة منتج للسلة
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // الحصول على السلة الحالية (أو إنشاء واحدة)
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id()
        ]);

        // هل المنتج موجود مسبقاً في السلة؟
        $item = CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $product->id)
                        ->first();

        if ($item) {
            // زيادة الكمية
            $item->quantity += 1;
            $item->save();
        } else {
            // إنشاء عنصر جديد
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price_at_time' => $product->price,
                'vendor_id' => $product->vendor_id, // الحل
            ]);
        }

        return redirect()->back()->with('success', 'تمت إضافة المنتج للسلة');
    }

    // إزالة منتج من السلة
    public function remove($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'تم حذف المنتج من السلة');
    }

    // تحديث كمية منتج
    public function update(Request $request, $id)
    {
        $item = CartItem::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $item->quantity = $request->quantity;
        $item->save();

        return redirect()->back()->with('success', 'تم تحديث الكمية');
    }
}