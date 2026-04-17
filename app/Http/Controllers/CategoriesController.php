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
            'name' => 'required|string|max:255',
            'status' => 'required',
            'image' => 'nullable|image|max:5000|mimes:jpg,jpeg,png,webp',
        ]);

        $data = $request->only(['name', 'status']);

        Category::create($data);

         // إذا كانت الصورة موجودة فقط
        if ($request->hasFile('image')) {
            // حفظ في storage/app/public/categories
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        if ($request->hasFile('image')) {   
                $category
                ->addMedia($request->file('image'))
                ->toMediaCollection('images');
        }

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

    // 2) Validation
    $request->validate([
        'name'   => 'sometimes|required|string|max:255',
        'status' => 'sometimes|required|in:Active,Inactive',
        'image'  => 'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:5000',
    ]);

        $data = $request->only(['name', 'status']);

    // 4) Update name if sent
    if ($request->has('name')) {
        $category->name = $request->name;
    }

    // 5) Handle image upload
    if ($request->hasFile('image')) {

        // if ($category->image && Storage::disk('public')->exists($category->image)) {
        //     Storage::disk('public')->delete($category->image);
        // } 
        $category
        ->addMedia($request->file('image'))
        ->toMediaCollection('images');
    
        // $imagePath = $request->file('image')->store('categories', 'public');
        // $category->image = $imagePath;
    }

    // حذف القسم
    function destroy($id)
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
}
