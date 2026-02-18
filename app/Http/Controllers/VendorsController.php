<?php

namespace App\Http\Controllers;
use App\Models\Vendor;
use App\Models\user;
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
        
        $vendors = Vendor::with('users')->get();
        return view('adminpanal.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreVendorRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('vendors','public');
        }

        Vendor::create($data);

        return redirect()->route('vendors.index')
            ->with('success','Vendor created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        return view('vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        return view('vendors.edit', compact('vendor'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        $request->validate([

        ]);

        $data = $request->only(['name','description','status']);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('vendors','public');
        }

        $vendor->update($data);

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
