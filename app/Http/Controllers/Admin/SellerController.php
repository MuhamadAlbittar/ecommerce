<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\user\StoreUserRequest;

class SellerController extends Controller
{
    // public function create()
    // {
    //     return view('adminpanal.user.addSeller');
    // }

    // public function edit($id)
    // {
    //     $seller = User::findOrFail($id);
    //     return view('adminpanal.user.editSeller', compact('seller'));
    // }
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        if(auth::user()->role !== 'customer'){
            $data['role'] = 'seller';
            $data['created_by'] = Auth::id();
        }

    //    dd($data);

        $user = User::create($data);
        if ($request->hasFile('image')) {
            $user->addMediaFromRequest('image')->toMediaCollection('user-image');
        }
        return redirect(route('sellers.index', absolute: false));
    }



    public function update(Request $request, $id)
    {
        $seller = User::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'building' => 'nullable|string|max:255',
        ]);
        $seller->update($data);
        if ($request->hasFile('image')) {
            $seller->clearMediaCollection('user-image');
            $seller->addMediaFromRequest('image')->toMediaCollection('user-image');
        }
        return redirect(route('sellers.index', absolute: false));
    }

    // اختياري: index لعرض قائمة البائعين
    public function index()
    {
        $sellers = User::where('role', 'seller')->where('created_by', Auth::id())->latest()->paginate(15);
        return view('adminpanal.user.index', compact('sellers'));
    }

    public function destroy($id)
    {
        $seller = User::findOrFail($id);
        $seller->delete();
        return redirect()->route('sellers.index')->with('success', 'Seller deleted successfully.');
    }
}
