<?php

namespace App\Http\Controllers;
use App\Models\Vendor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Vendor\StoreVendorRequest;
use App\Http\Requests\Vendor\UpdateVendorRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::all();
        return view('adminpanal.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminpanal.vendors.add');
    }

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
        return redirect()->route('vendors.index')
            ->with('success','Vendor created');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Vendor $vendor)
    // {
    //     return view('adminpanal.vendors.show', compact('vendor'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        return view('adminpanal.vendors.edit', compact('vendor'));
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

}
