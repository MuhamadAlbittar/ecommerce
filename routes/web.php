<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    OrdersController,
    OrderItemsController,
    OrderVendorsController,
    OrderShipmentsController,
    CartsController,
    CartItemsController,
    ProductsController,
    VendorProductsController,
    VendorsController,
    VendorUsersController,
    CategoriesController,
    ProductCategoriesController,
    PaymentsController,
    PaymentMethodsController,
    RefundsController,
    RefundItemsController,
    ShippingMethodsController,
    VendorShippingMethodsController
};

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::resources([
    'orders' => OrdersController::class,
    'order-items' => OrderItemsController::class,
    'order-vendors' => OrderVendorsController::class,
    'order-shipments' => OrderShipmentsController::class,

    'carts' => CartsController::class,
    'cart-items' => CartItemsController::class,

    'products' => ProductsController::class,
    'vendor-products' => VendorProductsController::class,

    'vendors' => VendorsController::class,
    'vendor-users' => VendorUsersController::class,

    'categories' => CategoriesController::class,
    'product-categories' => ProductCategoriesController::class,

    'payments' => PaymentsController::class,
    'payment-methods' => PaymentMethodsController::class,

    'refunds' => RefundsController::class,
    'refund-items' => RefundItemsController::class,

    'shipping-methods' => ShippingMethodsController::class,
    'vendor-shipping-methods' => VendorShippingMethodsController::class,
]);
// Storefront
Route::get('/store', [\App\Http\Controllers\StoreController::class, 'index'])->name('store.index');

// Cart
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{id}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [\App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');




// Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
// Route::post('/products', [ProductsController::class, 'create'])->name('products.create');
// Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
// Route::delete('/products/{delete_id}',[ProductsController::class,'destroy'])->name('products.delete');
// Route::put('/products/{program}',[ProductsController::class,'update'])->name('products.update');






// Route::get('/products/addList', function () {
//     return view('adminPanal.product.addList');
// })->name('products.create');

// Route::get('/products',[ProductsController::class,'create'])->name('products.create');

// Route::resource('products', ProductsController::class)->except(['create']);


// Route::get('/products/create-page', function () {
//     return view('adminPanal.product.create');
// })->name('products.create.page');



























// العملية                                     الراوت            الميثود

// GET              /model                              index   عرض قائمة العناصر

// GET             /model/create                        create  الإضافة صفحة عرض  

// POST             /model                               store   جديد حفظ 

// GET              /model/{id}                          show     عنصر عرض        

// GET              /model/{id}/edit                     edit     التعديل صفحة عرض  

// PUT             /PATCH /model/{id}                   update   تحديث

// DELETE           /model/{id}                        destroy     حذف  







