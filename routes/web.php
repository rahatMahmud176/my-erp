<?php

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\CountryVariantController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubUnitController;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Backend\ItemController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\ChallanController;
use App\Http\Controllers\Backend\TransitionController;
use App\Http\Controllers\Backend\SupplierTransitionController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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



    // Ajax Routes 
    Route::get('get-item-info',[StockController::class, 'itemInfo'])->name('get-item-info');
    Route::get('get-account-info-without-first-one',[StockController::class, 'acInfoWithOutFirstOne'])->name('get-account-info-without-first-one');
    Route::get('add-stock-row',[StockController::class, 'addStockRow'])->name('add-stock-row');


});




// -------------Route by me ---------------



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
