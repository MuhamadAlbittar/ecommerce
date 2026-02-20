<?php

namespace App\Http\Controllers;

use App\Models\Product;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'Active')->get();

        return view('store.index', compact('products'));
    }
}