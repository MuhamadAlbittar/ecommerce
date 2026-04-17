<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\CartItemsController;
use App\Http\Controllers\OrderItemsController;
use App\Http\Controllers\OrderShipmentsController;
use App\Http\Controllers\OrderVendorsController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\RefundItemsController;
use App\Http\Controllers\RefundsController;
use App\Http\Controllers\ShippingMethodsController;
use App\Http\Controllers\SupportSettingController;
use App\Http\Controllers\VendorProductsController;
use App\Http\Controllers\VendorShippingMethodsController;
use Illuminate\Support\Facades\Route;

// ==================== مسارات عامة (بدون مصادقة) ====================
Route::get('/', [StoreController::class, 'index'])->name('store.home');
Route::get('/store', [StoreController::class, 'index'])->name('store.index');
Route::get('/shop/category/{id?}', [StoreController::class, 'category'])->name('shop.category');
Route::get('/contact', [StoreController::class, 'contact'])->name('store.contact');

// ==================== مسارات تحتاج مصادقة (auth) ====================
Route::middleware(['auth'])->group(function () {

    // الملف الشخصي
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // العناوين
    Route::resource('addresses', UserAddressController::class)->except(['show']);
    Route::post('addresses/{address}/set-default', [UserAddressController::class, 'setDefault'])->name('addresses.setDefault');

    // السلة والطلبات للعملاء
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    Route::post('/order', [OrdersController::class, 'store'])->name('orders.store');
    Route::get('/order/success/{id}', [OrdersController::class, 'confirmation'])->name('orders.confirmation');
    Route::post('/orders/{order}/status', [OrdersController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/orders/{order}/invoice', [OrdersController::class, 'invoice'])->name('orders.invoice');

    Route::resources([
        'carts' => CartsController::class,
        'cart-items' => CartItemsController::class,
        'payments' => PaymentsController::class,
        'payment-methods' => PaymentMethodsController::class,
        'refunds' => RefundsController::class,
        'refund-items' => RefundItemsController::class,
    ]);
});

// ==================== مسارات البائع (seller) ====================
Route::middleware(['auth', 'UserRole:seller'])->group(function () {
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
        'shipping-methods' => ShippingMethodsController::class,
        'vendor-shipping-methods' => VendorShippingMethodsController::class,
    ]);
});

// ==================== مسارات الأدمن (admin) ====================
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('adminPanal.index');
    })->name('dashboard');

    Route::resource('categories', CategoriesController::class);
    Route::resource('products', ProductsController::class);

    // إدارة البائعين
    Route::get('sellers', [SellerController::class, 'index'])->name('sellers.index');
    Route::get('sellers/create', [SellerController::class, 'create'])->name('sellers.create');
    Route::post('sellers', [SellerController::class, 'store'])->name('sellers.store');
    Route::get('sellers/{id}/edit', [SellerController::class, 'edit'])->name('sellers.edit');
    Route::put('sellers/{id}', [SellerController::class, 'update'])->name('sellers.update');
    Route::delete('sellers/{id}', [SellerController::class, 'destroy'])->name('sellers.destroy');
});

// ==================== مسارات إضافية ====================
Route::post('/vendors/{vendor}/users', [VendorsController::class, 'addUser'])->name('vendors.users.store');
Route::put('/vendors/{vendor}/users/{user}', [VendorsController::class, 'updateUser'])->name('vendors.users.update');
Route::delete('/vendors/{vendor}/users/{user}', [VendorsController::class, 'removeUser'])->name('vendors.users.destroy');

Route::get('/support-settings', [SupportSettingController::class, 'index'])->name('support.index');
Route::post('/support-settings', [SupportSettingController::class, 'update'])->name('support.update');

// ==================== مسارات المصادقة (Breeze) ====================
require __DIR__.'/auth.php';




///--------------------------------------------------------------------------------
//  القديم  للاحطياط



/*
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

// auth profile route
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// User Addresses
Route::resource('addresses', UserAddressController::class)->except(['show']);
Route::post('addresses/{address}/set-default', [UserAddressController::class, 'setDefault'])
     ->name('addresses.setDefault');
    });
// catigory route
Route::middleware(['auth','UserRole:seller,admin'])->group(function () {
 Route::resources([
    'categories' => CategoriesController::class,
    ]);
});

Route::middleware(['auth','UserRole:admin'])->group(function () {
    Route::post('/categories/{category}/approve', [CategoriesController::class, 'approve'])->name('categories.approve');
    Route::post('/categories/{category}/reject', [CategoriesController::class, 'reject'])->name('categories.reject');
});

Route::post('/categories/{category}/status', [CategoriesController::class, 'changeStatus'])
    ->name('categories.changeStatus');

    //sending notification to sellers when category is approved or rejected
Route::get('/notifications/{id}', function ($id) {
    $notification = auth()->user()->notifications()->find($id);
    if ($notification) {$notification->markAsRead();
        return redirect($notification->data['url']);
    }
    return back();
})->name('notifications.read');

Route::middleware(['auth','UserRole:seller'])->group(function () {
 Route::resources([
    'products' => ProductsController::class,
    'vendor-products' => VendorProductsController::class,
    'vendors' => VendorsController::class,
    'product-categories' => ProductCategoriesController::class,
    'orders' => OrdersController::class,
    'order-items' => OrderItemsController::class,
    'order-vendors' => OrderVendorsController::class,
    'order-shipments' => OrderShipmentsController::class,
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
Route::put('/vendors/{vendor}/users/{user}', [VendorsController::class, 'updateUser'])->name('vendors.users.update');
Route::delete('/vendors/{vendor}/users/{user}', [VendorsController::class, 'removeUser'])->name('vendors.users.destroy');


require __DIR__.'/auth.php';
Route::resources([
    'carts' => CartsController::class,
    'cart-items' => CartItemsController::class,
    'payments' => PaymentsController::class,
    'payment-methods' => PaymentMethodsController::class,

    'refunds' => RefundsController::class,
    'refund-items' => RefundItemsController::class,

]);

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
