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
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        if ($request->hasFile('image')) {   
                $category
                ->addMedia($request->file('image'))
                ->toMediaCollection('images');
        }

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
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
    // 1) Get category FIRST
    $category = Category::findOrFail($id);

    // 2) Validation
    $request->validate([
        'name'   => 'sometimes|required|string|max:255',
        'status' => 'sometimes|required|in:Active,Inactive',
        'image'  => 'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:5000',
    ]);

    // 3) Update status only if sent
    if ($request->has('status')) {
        $category->status = $request->status;
    }

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

    // 6) Save
    $category->save();

    // 7) Redirect
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
