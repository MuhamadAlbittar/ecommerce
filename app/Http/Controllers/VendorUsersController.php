<?php

namespace App\Http\Controllers;
use App\Models\VendorUser;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendorUsers = VendorUser::with(['user','vendor'])->get();
        return view('vendor_users.index', compact('vendorUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $vendors = Vendor::all();
        return view('vendor_users.create', compact('users','vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vendor_id'=>'required|exists:vendors,id',
            'user_id'=>'required|exists:users,id',
            'role'=>'required|string',
        ]);

        VendorUser::create($request->all());
        return redirect()->route('vendor-users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(VendorUser $vendorUser)
    {
        return view('vendor_users.show', compact('vendorUser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VendorUser $vendorUser)
    {
        $users = User::all();
        $vendors = Vendor::all();
        return view('vendor_users.edit', compact('vendorUser','users','vendors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VendorUser $vendorUser)
    {
        $request->validate([
            'vendor_id'=>'required|exists:vendors,id',
            'user_id'=>'required|exists:users,id',
            'role'=>'required|string',
        ]);

        $vendorUser->update($request->all());
        return redirect()->route('vendor-users.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VendorUser $vendorUser)
    {
        $vendorUser->delete();
        return redirect()->route('vendor-users.index');
    }
}
