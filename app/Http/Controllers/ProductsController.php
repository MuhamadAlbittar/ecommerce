<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product ::all();
        $categories = Category ::all();
        return view('adminPanal.product.index', compact ('products', 'categories')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('adminPanal.product.addList', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
            // 1) التحقق من البيانات
            $validated = $request->validate([
                'name'        => 'required|string|max:255',
                'product_id'  => 'nullable|string',
                'sku'         => 'nullable|string',
                'vendor'      => 'nullable|string',
                'description' => 'nullable|string',
                'category_id' => 'nullable|exists:categories,id',
                'price'       => 'required|numeric',
                'sale_price'  => 'nullable|numeric',
                'tags'        => 'nullable|string',
                'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'status'      => 'nullable|string|in:active,inactive'
            ]);

            // 2) رفع الصورة إذا موجودة
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/products'), $imageName);

                // إضافة اسم الصورة للمصفوفة
                $validated['image'] = $imageName;
            }

            // 3) إنشاء المنتج
            Product::create($validated);

            // 4) إعادة التوجيه
            return redirect()->route('products.index')->with('success', 'تم اضافة المنتج بنجاح');
        }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('adminPanal.product.edit', compact('product', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'product_id'  => 'nullable|string',
            'sku'         => 'nullable|string',
            'vendor'      => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'price'       => 'required|numeric',
            'sale_price'  => 'nullable|numeric',
            'tags'        => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'nullable|string|in:active,inactive'
        ]);

        // تحديث الصورة إذا تم رفع واحدة جديدة
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
            $validated['image'] = $imageName;
        }

        // تحديث المنتج
        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'تم تحديث المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // حذف الصورة إذا موجودة
        if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
            unlink(public_path('uploads/products/' . $product->image));
        }

        // حذف المنتج
        $product->delete();

        return redirect()->route('products.index')->with('success', 'تم حذف المنتج بنجاح');
    }
}
