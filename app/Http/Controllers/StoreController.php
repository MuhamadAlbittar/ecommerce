<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'In Stock')->get();

        return view('store.index', compact('products'));
    }

    public function category($id = null)
    {
        // جلب كل التصنيفات
        $categories = Category::all();

        // إذا ما تم تحديد صنف معيّن، رجّع كل المنتجات
        if ($id) {
            $products = Product::where('category_id', $id)->paginate(9);
        } else {
            $products = Product::paginate(9);
        }
        // أفضل المنتجات
        $bestSellers = Product::latest()->take(10)->get();

        return view('store.category', compact('categories', 'products', 'bestSellers'));
    }
    
}