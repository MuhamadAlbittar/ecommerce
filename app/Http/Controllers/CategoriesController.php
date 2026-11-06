<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('adminpanal.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('adminpanal.category.addList' , compact('request'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //    $request->validate([
    //         'name' => 'required|string|max:255',
    //         'status' => 'required',
    //         'image' => 'nullable|image|max:5000|mimes:jpg,jpeg,png,webp',
    //     ]);

    //     $data = $request->only(['name', 'status']);

    //     Category::create($data);

    //      // إذا كانت الصورة موجودة فقط
    //     if ($request->hasFile('image')) {
    //         $data['image'] = $request->file('image')->store('categories', 'public');
    //     }

    //     if ($request->hasFile('image')) {   
    //             $category
    //             ->addMedia($request->file('image'))
    //             ->toMediaCollection('images');
    //     }

    //     return redirect()->route('categories.index')
    //         ->with('success', 'Category created successfully.');
    // }

    public function store(Request $request)
    {
        // 1. تحقق من الحقول المطلوبة (Validation)
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // شروط الصورة
        ]);

        // 2. إنشاء التصنيف وحفظه في متغير باسم $category
        // (هنا تم حل مشكلة Undefined variable)
        $category = Category::create([
            'name' => $request->name,
            // أضف أي حقول أخرى هنا إذا كانت موجودة في الفورم
        ]);

        // 3. رفع الصورة وربطها بالتصنيف باستخدام حزمة سباتشي
        if ($request->hasFile('image')) {
            $category->addMediaFromRequest('image')
                    ->toMediaCollection('images');
        }

        // 4. إعادة التوجيه بعد النجاح
        return redirect()->route('categories.index')->with('success', 'تم إنشاء التصنيف بنجاح');
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
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('adminpanal.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 1) جلب التصنيف أولاً
        $category = Category::findOrFail($id);

        // 2) التحقق من البيانات المرسلة
        $request->validate([
            'name'   => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|in:Active,Inactive',
            'image'  => 'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:5000',
        ]);

        // 3) تحديث الحقول النصية إذا تم إرسالها
        if ($request->has('status')) {
            $category->status = $request->status;
        }

        if ($request->has('name')) {
            $category->name = $request->name;
        }

        // 4) التعامل مع رفع وتحديث الصورة عبر سباتشي
        if ($request->hasFile('image')) {
            // 💡 حذف الصور القديمة المسجلة لهذا التصنيف لكي تحل الصورة الجديدة مكانها فوراً
            $category->clearMediaCollection('images');

            // رفع الصورة الجديدة وتخزينها
            $category->addMedia($request->file('image'))
                    ->toMediaCollection('images');
        }

        // 5) حفظ التغييرات في قاعدة البيانات
        $category->save();

        // 6) إعادة التوجيه
        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // حذف الصورة إذا موجودة
        if ($category->image && file_exists(public_path('uploads/categories/' . $category->image))) {
            unlink(public_path('uploads/categories/' . $category->image));
        }

        if ($category->products()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete category with existing products');
        }

        $category->delete();

        return redirect()->route('categories.index')
                 ->with('success', 'Category deleted successfully');
    }
}
