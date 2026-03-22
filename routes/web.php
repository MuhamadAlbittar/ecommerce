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
    VendorUsersController,
    CategoriesController,
    ProductCategoriesController,
    PaymentsController,
    PaymentMethodsController,
    RefundsController,
    RefundItemsController,
    ShippingMethodsController,
    VendorShippingMethodsController,
    StoreController
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
// User Addresses
Route::resource('addresses', UserAddressController::class)->except(['show']);
Route::post('addresses/{address}/set-default', [UserAddressController::class, 'setDefault'])
     ->name('addresses.setDefault');
    });

require __DIR__.'/auth.php';
Route::resources([
    'orders' => OrdersController::class,
    'order-items' => OrderItemsController::class,
    'order-vendors' => OrderVendorsController::class,
    'order-shipments' => OrderShipmentsController::class,

    'carts' => CartsController::class,
    'cart' => CartController::class,
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

    // 'store' => StoreController::class,

]);
// Storefront
Route::get('/home', [\App\Http\Controllers\StoreController::class, 'index'])->name('store.index');
// Cart
Route::get('/cart', [\App\Http\Controllers\CartsController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{id}', [\App\Http\Controllers\CartItemsController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{id}', [\App\Http\Controllers\CartItemsController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [\App\Http\Controllers\CartsController::class, 'clear'])->name('cart.clear');
Route::get('/track', [\App\Http\Controllers\OrdersController::class, 'track'])->name('orders.track');
Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');



// Route::get('/home', function () {
//     return view('store.index');
// })->name('home');



