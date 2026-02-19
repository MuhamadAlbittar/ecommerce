<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products   = Product::with('categories')->latest()->paginate(15);
        $categories = Category::all();

        return view('adminPanal.product.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('adminPanal.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
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
            'status'      => 'nullable|string|in:Active,Inactive',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('products', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'تم اضافة المنتج بنجاح');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::all();

        return view('adminPanal.product.edit', compact('product', 'categories'));
    }

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
            'status'      => 'nullable|string|in:Active,Inactive',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')
                ->store('products', 'public');
        }

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'تم تحديث المنتج بنجاح');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'تم حذف المنتج بنجاح');
    }
}
