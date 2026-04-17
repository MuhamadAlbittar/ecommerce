<?php

namespace App\Http\Controllers;

use App\Events\aproveCatigory;
use App\Http\Requests\category\CategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \Illuminate\Support\Str;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\Controller;
// use App\Notifications\CategoryApprovedNotification;
// use App\Notifications\CategoryRejectedNotification;
use App\Notifications\CategoryStatusNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;



class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $categories = Category::with('creator')
        ->forUser()
        ->latest()
        ->get();
        return view('adminPanal.categories.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name);
        $data['added_by'] = Auth::id();
        $data['approval_status'] = Auth::user()->role !== 'admin' ? 'pending' : 'approved';
        $category = Category::create($data);
        if ($request->hasFile('image')) {
            $category->addMediaFromRequest('image')->toMediaCollection('category-logo');
        }

        return back()->with('success', 'Category added successfully');
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name);
        $data['approval_status'] = Auth::user()->role !== 'admin' ? 'pending' : 'approved';
        $category->update($data);
        if ($request->hasFile('image')) {
            $category->clearMediaCollection('category-logo');
            $category->addMediaFromRequest('image')->toMediaCollection('category-logo');
        }
        return back()->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Category deleted');
    }
    // // الوظيفة الموافقة على التصنيف (للمسؤول)
    // public function approve(Category $category)
    // {
    //     $category->update(['approval_status' => 'approved']);
    //     $seller = User::find($category->added_by);

    //     if ($seller) {
    //         $seller->notify(new CategoryStatusNotification($category, $status));
    //     }

    //     return back()->with('success', 'Approved');
    // }
    // // الوظيفة رفض التصنيف (للمسؤول) - يمكن تعديلها حسب الحاجة (مثلاً حذف التصنيف بدلاً من رفضه)
    // public function reject(Category $category)
    // {
    //     $category->update(['approval_status' => 'rejected']);
    //         $seller = User::find($category->added_by);

    //     if ($seller) {
    //         $seller->notify(new CategoryStatusNotification($category, $status));
    //     }
    //     return back()->with('success', 'Rejected');
    // }


    public function changeStatus(Request $request, Category $category)
    {
        $request->validate(['status' => 'required|in:approved,rejected,pending']);
        $status = $request->status;
        $category->update(['approval_status' => $status]);
           try {
        Log::info('Attempting to broadcast event...');
        event(new aproveCatigory($category));
        Log::info('Event broadcasted successfully');
        } catch (\Exception $e) {
            Log::error('Failed to broadcast event: ' . $e->getMessage());
        }
        $user = User::find($category->added_by);

        if ($user) {$user->notify(new CategoryStatusNotification($category, $status));}


        return back();
    }
}
