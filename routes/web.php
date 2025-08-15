<?php

use Illuminate\Support\Facades\Route;
use App\Exports\UserExport;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Maatwebsite\Excel\Facades\Excel;
use App\Livewire\IndexPage;

// Route::get('/', [ProductController::class, 'index'])->name('products.index');
// Route::get('products/index', [ProductController::class, 'index'])->name('products.index');
// Route::get('/products/pizza', function () {
//     return view('products/pizza');
// });
Route::get('/', function () {
    return view('home');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('superadmin/user/index','superadmin.user.index')->name('superadmin.user.index')->middleware('auth');
Route::view('superadmin/category/index','superadmin.category.index')->name('superadmin.category.index')->middleware('auth');
Route::view('superadmin/product/index','superadmin.product.index')->name('superadmin.product.index')->middleware('auth');
Route::view('superadmin/role/index','superadmin.role.index')->name('superadmin.role.index')->middleware('auth');
Route::view('superadmin/permission/index','superadmin.permission.index')->name('superadmin.permission.index')->middleware('auth');
Route::view('home','home')->name('home');



Route::get('superadmin/user/excel', function () {
    $filename = now()->format('d-m-Y_H.i.s');
    return Excel::download(new UserExport, 'DataUser_'.$filename.'.xlsx');
})->name('superadmin.user.excel')->middleware('auth');

Route::get('superadmin/user/pdf', [UserController::class,'pdf'])
->name('userPdf')->middleware('auth');

require __DIR__.'/auth.php';


