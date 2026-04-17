<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Vendor;
use App\Models\VendorProduct;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductsController extends Controller
{
    /**
     * عرض قائمة منتجات الـ Vendor المحدد
     */
    public function index(Vendor $vendor)
    {
        // تأكد أن المستخدم ينتمي لهذا الـ Vendor
        $this->authorizeVendorAccess($vendor);

        // جلب منتجات هذا الـ Vendor مع التصنيفات
        $vendorProducts = VendorProduct::with(['product.categories'])
            ->where('vendor_id', $vendor->id)
            ->latest()
            ->paginate(15);

        return view('adminpanal.vendors.products.index', compact('vendor', 'vendorProducts'));
    }

    /**
     * عرض صفحة إضافة منتج جديد للـ Vendor
     */
    public function create(Vendor $vendor)
    {
        $this->authorizeVendorAccess($vendor);

        // جلب كل المنتجات التي لم يضيفها هذا الـ Vendor بعد
        $availableProducts = Product::whereDoesntHave('vendors', function ($q) use ($vendor) {
            $q->where('vendor_id', $vendor->id);
        })->get();

        $categories = Category::all();

        return view('adminpanal.vendors.products.create', compact('vendor', 'availableProducts', 'categories'));
    }

    /**
     * حفظ منتج جديد للـ Vendor
     */
    public function store(Request $request, Vendor $vendor)
    {
        $this->authorizeVendorAccess($vendor);

        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'price'      => ['required', 'numeric', 'min:0'],
            'quantity'   => ['required', 'integer', 'min:0'],
            'sku'        => ['nullable', 'string', 'max:100'],
        ]);

        // تحقق أن هذا المنتج لم يُضاف مسبقاً لهذا الـ Vendor
        $exists = VendorProduct::where('vendor_id', $vendor->id)
            ->where('product_id', $data['product_id'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['product_id' => 'هذا المنتج موجود مسبقاً في متجرك']);
        }

        VendorProduct::create([
            'vendor_id'  => $vendor->id,
            'product_id' => $data['product_id'],
            'price'      => $data['price'],
            'quantity'   => $data['quantity'],
            'sku'        => $data['sku'] ?? null,
        ]);

        return redirect()->route('vendors.products.index', $vendor)
            ->with('success', 'تم إضافة المنتج بنجاح');
    }

    /**
     * عرض صفحة تعديل منتج الـ Vendor
     */
    public function edit(Vendor $vendor, VendorProduct $vendorProduct)
    {
        $this->authorizeVendorAccess($vendor);

        // تأكد أن هذا الـ VendorProduct ينتمي لهذا الـ Vendor
        abort_if($vendorProduct->vendor_id !== $vendor->id, 403);

        return view('adminpanal.vendors.products.edit', compact('vendor', 'vendorProduct'));
    }

    /**
     * تحديث بيانات منتج الـ Vendor (السعر، الكمية...)
     */
    public function update(Request $request, Vendor $vendor, VendorProduct $vendorProduct)
    {
        $this->authorizeVendorAccess($vendor);

        abort_if($vendorProduct->vendor_id !== $vendor->id, 403);

        $data = $request->validate([
            'price'    => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'sku'      => ['nullable', 'string', 'max:100'],
        ]);

        $vendorProduct->update($data);

        return redirect()->route('vendors.products.index', $vendor)
            ->with('success', 'تم تحديث المنتج بنجاح');
    }

    /**
     * حذف منتج من قائمة منتجات الـ Vendor
     */
    public function destroy(Vendor $vendor, VendorProduct $vendorProduct)
    {
        $this->authorizeVendorAccess($vendor);

        abort_if($vendorProduct->vendor_id !== $vendor->id, 403);

        $vendorProduct->delete();

        return redirect()->route('vendors.products.index', $vendor)
            ->with('success', 'تم حذف المنتج');
    }

    // ==========================================
    // Helper Method — نتجنب تكرار كود التحقق
    // ==========================================

    /**
     * التحقق أن المستخدم الحالي عضو في هذا الـ Vendor
     */
    private function authorizeVendorAccess(Vendor $vendor): void
    {
        $isMember = $vendor->users()
            ->where('user_id', Auth::id())
            ->exists();

        abort_if(! $isMember, 403, 'ليس لديك صلاحية للوصول لهذا المتجر');
    }
}
