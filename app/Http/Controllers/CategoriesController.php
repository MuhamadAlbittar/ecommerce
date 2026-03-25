<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    // عرض جميع الأقسام
    public function index()
    {
        $categories = Category::latest()->get();
        return view('adminPanal.category.index', compact('categories'));
    }

    // عرض صفحة الإضافة
    public function create()
    {
        return view('adminPanal.category.addList');
    }

    // حفظ القسم الجديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'required|in:Active,Inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['name', 'status']);

        if ($request->hasFile('image')) {
            // حفظ في storage/app/public/categories
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'تم إنشاء القسم بنجاح');
    }

    // عرض صفحة التعديل
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('adminPanal.category.edit', compact('category'));
    }

    // تحديث القسم
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'status' => 'required|in:Active,Inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['name', 'status']);

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة بطريقة صحيحة
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            // حفظ الجديدة
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'تم تحديث القسم بنجاح');
    }

    // حذف القسم
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // التحقق: هل يوجد منتجات مرتبطة بهذا القسم؟
        // (يجب أن تكون لديك علاقة products في موديل Category)
        if ($category->products()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'لا يمكن حذف القسم لأنه يحتوي على منتجات!');
        }

        // حذف الصورة من التخزين
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'تم حذف القسم بنجاح');
    }
}
