<?php

namespace App\Http\Controllers;
use App\Models\Vendor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Vendor\StoreVendorRequest;
use App\Http\Requests\Vendor\UpdateVendorRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = auth()->user()->vendors()->get();
        return view('adminpanal.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('adminpanal.vendors.add');
    // }
      /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Vendor $vendor)
    // {
    //     return view('adminpanal.vendors.edit', compact('vendor'));
    // }

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreVendorRequest $request)
    {
        $data = $request->validated();
        $vendor = Vendor::create($data);
        // $vendor->addMedia($vendor->image)->toMediaCollection('image');
       if ($request->hasFile('image')) {
           $vendor->addMediaFromRequest('image')->toMediaCollection('vendor-logo');
       }
        // dd($data);
        $vendor->users()->attach(Auth::id(), [
        'role' => 'owner',
        'permissions' => ['all'],
        'added_by' => Auth::id(),
    ]);
        return redirect()->route('vendors.index')
            ->with('success','Vendor created');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
         $data = $request->validated();

         $vendor->update($data);

       if ($request->hasFile('image')) {
           $vendor->clearMediaCollection('image')->addMediaFromRequest('image')->toMediaCollection('vendor-logo');
       }
    //    dd($data);
        return redirect()->route('vendors.index')
            ->with('success','Vendor updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendors.index')
            ->with('success','Vendor deleted');
    }

     /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor){
            $vendor->load('users'); // تحميل العلاقة فقط

            $availableUsers = User::whereDoesntHave('vendors', function ($q) use ($vendor) {
                $q->where('vendor_id', $vendor->id);
                })->where('created_by', auth()->id())->get();

            return view('adminpanal.vendors.show', [
                'vendor' => $vendor,
                'users' => $availableUsers
            ]);
    }

    public function addUser(Request $request, Vendor $vendor)
        {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:manager,staff',
            'permissions' => 'nullable|array'
        ]);

        //  التأكد أن المستخدم الحالي Owner أو Manager
        $currentUser = $vendor->users()
            ->where('user_id', Auth::id())
            ->first();

        if (!$currentUser) {
            abort(403, 'You are not part of this vendor');
        }

        $currentRole = $currentUser->pivot->role;

        //  تحديد من يمكنه الإضافة
        if ($request->role === 'manager' && $currentRole !== 'owner') {
            abort(403, 'Only owner can add manager');
        }

        if ($request->role === 'staff' && !in_array($currentRole, ['owner', 'manager'])) {
            abort(403, 'You are not allowed to add staff');
        }

        // إضافة المستخدم للمتجر
        $vendor->users()->attach($request->user_id, [
            'role' => $request->role,
            'permissions' => $request->permissions ?? []
        ]);

        return back()->with('success', 'User added successfully');
     }

    public function updateUser(Request $request, Vendor $vendor, User $user)
        {
            // 🔥 التحقق من الصلاحية
            Gate::authorize('updateUser', $vendor);

            $vendor->users()->updateExistingPivot($user->id, [
                'role' => $request->role,
                'permissions' => $request->permissions ?? [],
            ]);

            return back()->with('success', 'User updated successfully');
        }
}
