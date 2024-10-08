<?php

use App\Http\Controllers\Backend\AdminCartController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\CountryVariantController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubUnitController;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\UserController; 
use App\Http\Controllers\Backend\ItemController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\ChallanController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Backend\TransitionController;
use App\Http\Controllers\Backend\SupplierTransitionController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\ProductHistoryController;
use App\Http\Controllers\Backend\salePurchaseController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard',[DashboardController::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// -------------Route by me ---------------

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function(){ 
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('country_variants', CountryVariantController::class);
    Route::resource('units', UnitController::class);
    Route::resource('sub_units', SubUnitController::class);
    Route::resource('items', ItemController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('stocks', StockController::class);
    Route::get('stock-details-{id}',[StockController::class,'stockDetails'])->name(('stock.details'));
    Route::resource('challans', ChallanController::class);
    Route::resource('transitions', TransitionController::class);
    Route::resource('supplier_transitions', SupplierTransitionController::class); 
    Route::resource('payments', PaymentController::class); 
    Route::post('direct-payment',[PaymentController::class,'directPayment'])->name('direct-payment');
    Route::post('direct-due-increase',[PaymentController::class,'directDueIncrease'])->name('direct-due-increase');
    Route::resource('pos', PosController::class); 
    Route::resource('cart', AdminCartController::class);
    Route::get('remove-cart-item/{id}',[AdminCartController::class,'removeCartItem'])->name('remove-cart-item');
    Route::resource('invoice', InvoiceController::class); 
    Route::resource('customers', CustomerController::class);
    Route::resource('product_history', ProductHistoryController::class);
    Route::resource('salePurchase', salePurchaseController::class);


    // Ajax Routes 
    Route::get('get-item-info',[StockController::class, 'itemInfo'])->name('get-item-info');
    Route::get('get-account-info-without-first-one',[StockController::class, 'acInfoWithOutFirstOne'])->name('get-account-info-without-first-one');
    Route::get('add-stock-row',[StockController::class, 'addStockRow'])->name('add-stock-row');
    Route::get('add-to-cart-ajax',[AdminCartController::class, 'addToCart'])->name('add-to-cart');
    Route::get('find-customer',[CustomerController::class, 'findCustomer'])->name('find-customer');
    
    Route::get('get-full-month-invoices',[InvoiceController::class, 'getFullMonthInvoice'])->name('get-full-month-invoices');
    Route::get('get-invoices-by-date',[InvoiceController::class, 'getInvoiceByDate'])->name('get-invoices-by-date');
    Route::get('get-today-invoices',[InvoiceController::class, 'getTodayInvoice'])->name('get-today-invoices');
   
    Route::get('get-full-month-challans',[ChallanController::class, 'getFullMonthChallans'])->name('get-full-month-challans');
    Route::get('get-challans-by-date',[ChallanController::class, 'getChallansByMonth'])->name('get-challans-by-date');
    Route::get('get-today-challans',[ChallanController::class, 'getTodayChallans'])->name('get-today-challans');
    Route::get('get-only-due-challans',[ChallanController::class, 'getDueChallans']);
    Route::get('get-challans-by-supplier',[ChallanController::class, 'getChallansBySupplier']);
   
    Route::get('get-previous-month-transition',[TransitionController::class, 'getPreviousMonthTransitions'])->name('get-previous-month-transition');
    Route::get('get-transitions-by-date',[TransitionController::class, 'getTransitionsByDate'])->name('get-transitions-by-date');
    Route::get('get-today-transitions',[TransitionController::class, 'getTodayTransitions'])->name('get-today-transitions');
    Route::get('get-this-month-transition',[TransitionController::class, 'getThisMonthTransitions'])->name('get-this-month-transition');
    
    Route::get('get-this-month-supplier-transition',[SupplierTransitionController::class, 'getThisMonthSupplierTransitions'])->name('get-this-month-supplier-transition');
    Route::get('get-previous-month-supplier-transition',[SupplierTransitionController::class, 'getPreviousMonthSupplierTransitions'])->name('get-previous-month-supplier-transition');
    Route::get('get-supplier-transition-by-date',[SupplierTransitionController::class, 'getSupplierTransitionsByDate']);
    Route::get('get-today-supplier-transition',[SupplierTransitionController::class, 'getSupplierTransitionsToday']);
   
    Route::get('get-pos-search-result',[PosController::class, 'searchResult'])->name('get-pos-search-result');
    Route::get('get-stock-by-category',[StockController::class, 'stockByCat'])->name('get-stock-by-category');
    Route::get('product-history-search',[ProductHistoryController::class, 'searchProductHistoryBranch'])->name('product-history-search');


});




// -------------Route by me ---------------



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/all-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return 'Clear Compleate !';
});