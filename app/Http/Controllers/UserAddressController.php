<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    /**
     * عرض كل عناوين المستخدم الحالي
     */
    public function index()
    {
        $addresses = UserAddress::where('user_id', Auth::id())
            ->orderByDesc('is_default')
            ->orderByDesc('created_at')
            ->get();

        return view('store.addresses.index', compact('addresses'));
    }

    /**
     * فورم إضافة عنوان جديد
     */
    public function create()
    {
        return view('store.addresses.create');
    }

    /**
     * حفظ العنوان الجديد
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'label'       => 'required|string|max:50',
            'full_name'   => 'required|string|max:100',
            'phone'       => 'required|string|max:20',
            'address'     => 'required|string|max:500',
            'city'        => 'required|string|max:100',
            'state'       => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country'     => 'required|string|max:100',
            'is_default'  => 'nullable',
        ]);

        $data['user_id']    = Auth::id();
        $data['is_default'] = $request->boolean('is_default');

        // إذا هذا أول عنوان، اجعله افتراضي تلقائياً
        $hasAddresses = UserAddress::where('user_id', Auth::id())->exists();
        if (!$hasAddresses) {
            $data['is_default'] = true;
        }

        // إذا اختار "افتراضي" — ازل الافتراضي القديم
        if ($data['is_default']) {
            UserAddress::where('user_id', Auth::id())
                ->update(['is_default' => false]);
        }

        UserAddress::create($data);

        return redirect()->route('addresses.index')
            ->with('success', '✅ Address added successfully!');
    }

    /**
     * فورم تعديل العنوان
     */
    public function edit(UserAddress $address)
    {
        // حماية: المستخدم يشوف عناوينه بس
        abort_if($address->user_id !== Auth::id(), 403, 'Unauthorized');

        return view('store.addresses.edit', compact('address'));
    }

    /**
     * تحديث العنوان
     */
    public function update(Request $request, UserAddress $address)
    {
        abort_if($address->user_id !== Auth::id(), 403, 'Unauthorized');

        $data = $request->validate([
            'label'       => 'required|string|max:50',
            'full_name'   => 'required|string|max:100',
            'phone'       => 'required|string|max:20',
            'address'     => 'required|string|max:500',
            'city'        => 'required|string|max:100',
            'state'       => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country'     => 'required|string|max:100',
            'is_default'  => 'nullable',
        ]);

        $data['is_default'] = $request->boolean('is_default');

        if ($data['is_default']) {
            UserAddress::where('user_id', Auth::id())
                ->where('id', '!=', $address->id)
                ->update(['is_default' => false]);
        }

        $address->update($data);

        return redirect()->route('addresses.index')
            ->with('success', '✅ Address updated successfully!');
    }

    /**
     * حذف العنوان
     */
    public function destroy(UserAddress $address)
    {
        abort_if($address->user_id !== Auth::id(), 403, 'Unauthorized');

        $wasDefault = $address->is_default;
        $address->delete();

        // إذا حذف العنوان الافتراضي — اجعل الأول الجديد افتراضياً
        if ($wasDefault) {
            $first = UserAddress::where('user_id', Auth::id())->first();
            $first?->update(['is_default' => true]);
        }

        return redirect()->route('addresses.index')
            ->with('success', '🗑️ Address deleted.');
    }

    /**
     * تعيين عنوان كافتراضي
     */
    public function setDefault(UserAddress $address)
    {
        abort_if($address->user_id !== Auth::id(), 403, 'Unauthorized');

        UserAddress::where('user_id', Auth::id())
            ->update(['is_default' => false]);

        $address->update(['is_default' => true]);

        return back()->with('success', '⭐ Default address updated!');
    }
}
