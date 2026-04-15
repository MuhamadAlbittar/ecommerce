<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    OrdersController,
    OrderItemsController,
    OrderVendorsController,
    OrderShipmentsController,
    CartController,
    CartsController,
    CartItemsController,
    ProductsController,
    VendorProductsController,
    VendorsController,
    CategoriesController,
    ProductCategoriesController,
    PaymentsController,
    PaymentMethodsController,
    RefundsController,
    RefundItemsController,
    ShippingMethodsController,
    VendorShippingMethodsController,
    StoreController,
    SupportSettingController,
    Admin\SellerController
};
Route::get('/', function () {return view('welcome');});
Route::middleware(['auth'])->group(function () {
    // لوحة التحكم للمسؤول أو البائع
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); //
    // صفحة العميل
    // Route::get('/home', function () {
    //     return view('store.index');
    // })->name('home');
    Route::get('/home', [StoreController::class, 'index'])->name('store.index');
    Route::get('/shop/category/{id?}', [StoreController::class, 'category'])->name('shop.category');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// User Addresses
Route::resource('addresses', UserAddressController::class)->except(['show']);
Route::post('addresses/{address}/set-default', [UserAddressController::class, 'setDefault'])
     ->name('addresses.setDefault');
    });

Route::middleware(['auth','UserRole:seller'])->group(function () {
 Route::resources([
    'orders' => OrdersController::class,
    'order-items' => OrderItemsController::class,
    'order-vendors' => OrderVendorsController::class,
    'order-shipments' => OrderShipmentsController::class,
    'products' => ProductsController::class,
    'vendor-products' => VendorProductsController::class,
    'vendors' => VendorsController::class,
    'categories' => CategoriesController::class,
    'product-categories' => ProductCategoriesController::class,
    'refunds' => RefundsController::class,
    'refund-items' => RefundItemsController::class,
    'shipping-methods' => ShippingMethodsController::class,
    'vendor-shipping-methods' => VendorShippingMethodsController::class,
    ]);
});
// Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('sellers', [SellerController::class, 'index'])->name('sellers.index');
        Route::get('sellers/create', [SellerController::class, 'create'])->name('sellers.create');
        Route::post('sellers', [SellerController::class, 'store'])->name('sellers.store');
        Route::get('sellers/{id}/edit', [SellerController::class, 'edit'])->name('sellers.edit');
        Route::put('sellers/{id}', [SellerController::class, 'update'])->name('sellers.update');
        Route::delete('sellers/{id}', [SellerController::class, 'destroy'])->name('sellers.destroy');
    });
    Route::post('/vendors/{vendor}/users', [VendorsController::class, 'addUser'])->name('vendors.users.store');
    Route::put('/vendors/{vendor}/users/{user}', [VendorsController::class, 'updateUser'])
    ->name('vendors.users.update');


require __DIR__.'/auth.php';
Route::resources([
    'carts' => CartsController::class,
    'cart-items' => CartItemsController::class,
    'payments' => PaymentsController::class,
    'payment-methods' => PaymentMethodsController::class,

    'refunds' => RefundsController::class,
    'refund-items' => RefundItemsController::class,

]);
// Storefront

// Cart
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{id}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [\App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');
Route::get('/store', [\App\Http\Controllers\StoreController::class, 'index'])->name('store.index');

Route::post('/orders/{order}/status', [OrdersController::class, 'updateStatus'])
    ->name('orders.updateStatus');
Route::get('/orders/{order}/invoice', [OrdersController::class, 'Invoice'])
    ->name('orders.Invoice');
Route::get('/contact', [\App\Http\Controllers\StoreController::class, 'contact'])->name('store.contact');

Route::get('/support-settings', [SupportSettingController::class, 'index'])->name('support.index');
Route::post('/support-settings', [SupportSettingController::class, 'create'])->name('support.create');
