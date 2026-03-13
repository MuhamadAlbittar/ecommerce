<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    public function index()
    {
        $addresses = UserAddress::where('user_id', Auth::id())->get();
        return view('store.addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('store.addresses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label'       => 'required|string|max:50',
            'full_name'   => 'required|string|max:100',
            'phone'       => 'required|string|max:20',
            'address'     => 'required|string',
            'city'        => 'required|string|max:100',
            'state'       => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country'     => 'required|string|max:100',
            'is_default'  => 'nullable|boolean',
        ]);

        $data['user_id'] = Auth::id();

        if (!empty($data['is_default'])) {
            UserAddress::where('user_id', Auth::id())
                ->update(['is_default' => false]);
        }

        UserAddress::create($data);

        return redirect()->route('addresses.index')
            ->with('success', 'Address added successfully!');
    }

    public function edit(UserAddress $address)
    {
        abort_if($address->user_id !== Auth::id(), 403);
        return view('store.addresses.edit', compact('address'));
    }

    public function update(Request $request, UserAddress $address)
    {
        abort_if($address->user_id !== Auth::id(), 403);

        $data = $request->validate([
            'label'       => 'required|string|max:50',
            'full_name'   => 'required|string|max:100',
            'phone'       => 'required|string|max:20',
            'address'     => 'required|string',
            'city'        => 'required|string|max:100',
            'state'       => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country'     => 'required|string|max:100',
            'is_default'  => 'nullable|boolean',
        ]);

        if (!empty($data['is_default'])) {
            UserAddress::where('user_id', Auth::id())
                ->where('id', '!=', $address->id)
                ->update(['is_default' => false]);
        }

        $address->update($data);

        return redirect()->route('addresses.index')
            ->with('success', 'Address updated successfully!');
    }

    public function destroy(UserAddress $address)
    {
        abort_if($address->user_id !== Auth::id(), 403);
        $address->delete();
        return redirect()->route('addresses.index')
            ->with('success', 'Address deleted successfully!');
    }

    public function setDefault(UserAddress $address)
    {
        abort_if($address->user_id !== Auth::id(), 403);

        UserAddress::where('user_id', Auth::id())
            ->update(['is_default' => false]);

        $address->update(['is_default' => true]);

        return back()->with('success', 'Default address updated!');
    }
}
