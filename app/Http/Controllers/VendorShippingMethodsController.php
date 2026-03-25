<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\ShippingMethod;
use App\Models\VendorShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorShippingMethodsController extends Controller
{
    /**
     * عرض طرق الشحن المفعّلة لهذا الـ Vendor
     */
    public function index(Vendor $vendor)
    {
        $this->authorizeVendorAccess($vendor);

        // طرق الشحن المفعّلة لهذا الـ Vendor
        $vendorShippingMethods = VendorShippingMethod::with('shippingMethod')
            ->where('vendor_id', $vendor->id)
            ->get();

        // طرق الشحن المتاحة التي لم يفعّلها الـ Vendor بعد
        $activatedIds = $vendorShippingMethods->pluck('shipping_method_id');
        $availableMethods = ShippingMethod::whereNotIn('id', $activatedIds)->get();

        return view('adminpanal.vendors.shipping.index', compact(
            'vendor',
            'vendorShippingMethods',
            'availableMethods'
        ));
    }

    /**
     * تفعيل طريقة شحن لهذا الـ Vendor مع تحديد السعر
     */
    public function store(Request $request, Vendor $vendor)
    {
        $this->authorizeVendorAccess($vendor);

        $data = $request->validate([
            'shipping_method_id' => ['required', 'exists:shipping_methods,id'],
            'price'              => ['required', 'numeric', 'min:0'],
            'estimated_days'     => ['nullable', 'integer', 'min:1'],
        ]);

        // تحقق من عدم التكرار
        $exists = VendorShippingMethod::where('vendor_id', $vendor->id)
            ->where('shipping_method_id', $data['shipping_method_id'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['shipping_method_id' => 'طريقة الشحن هذه مفعّلة مسبقاً']);
        }

        VendorShippingMethod::create([
            'vendor_id'          => $vendor->id,
            'shipping_method_id' => $data['shipping_method_id'],
            'price'              => $data['price'],
            'estimated_days'     => $data['estimated_days'] ?? null,
        ]);

        return back()->with('success', 'تم إضافة طريقة الشحن بنجاح');
    }

    /**
     * تحديث سعر طريقة الشحن
     */
    public function update(Request $request, Vendor $vendor, VendorShippingMethod $vendorShippingMethod)
    {
        $this->authorizeVendorAccess($vendor);

        abort_if($vendorShippingMethod->vendor_id !== $vendor->id, 403);

        $data = $request->validate([
            'price'          => ['required', 'numeric', 'min:0'],
            'estimated_days' => ['nullable', 'integer', 'min:1'],
        ]);

        $vendorShippingMethod->update($data);

        return back()->with('success', 'تم تحديث طريقة الشحن');
    }

    /**
     * تعطيل طريقة شحن لهذا الـ Vendor
     */
    public function destroy(Vendor $vendor, VendorShippingMethod $vendorShippingMethod)
    {
        $this->authorizeVendorAccess($vendor);

        abort_if($vendorShippingMethod->vendor_id !== $vendor->id, 403);

        $vendorShippingMethod->delete();

        return back()->with('success', 'تم حذف طريقة الشحن');
    }

    private function authorizeVendorAccess(Vendor $vendor): void
    {
        $isMember = $vendor->users()
            ->where('user_id', Auth::id())
            ->exists();

        abort_if(! $isMember, 403, 'ليس لديك صلاحية للوصول لهذا المتجر');
    }
}
