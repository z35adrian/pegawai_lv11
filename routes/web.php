<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    route::get('admin/dashboard', [HomeController::class,'index']);
    route::get('admin/create', [HomeController::class,'create']);
    route::post('admin/store', [HomeController::class,'store']);
    route::get('admin/show/{id}',[HomeController::class,'show']);
    route::get('admin/edit/{id}',[HomeController::class,'edit']);
    route::put('admin/update/{id}',[HomeController::class,'update']);
    route::delete('admin/destroy/{id}',[HomeController::class,'destroy']);
    route::get('admin/data_pegawai', [HomeController::class,'data_pegawai']);

    route::get('admin/userdata/data_user', [UserController::class,'data_user']);
    route::get('admin/userdata/create', [UserController::class,'create']);
    route::post('admin/userdata/store', [UserController::class,'store']);
    route::get('admin/userdata/edit/{id}',[UserController::class,'edit']);
    route::put('admin/userdata/update/{id}',[UserController::class,'update']);
    route::get('admin/userdata/show/{id}',[UserController::class,'show']);
    route::delete('admin/userdata/destroy/{id}',[UserController::class,'destroy']);

});


require __DIR__.'/auth.php';
route::get('supervisor/dashboard', [SupervisorController::class,'index'])->middleware(['auth','supervisor']);
route::get('supervisor/data_pegawai', [SupervisorController::class,'data_pegawai'])->middleware(['auth','supervisor']);
route::get('supervisor/show/{id}',[SupervisorController::class,'show'])->middleware(['auth','supervisor']);

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('dashboard', [UserController::class, 'index']);
Route::get('tabel_user', [UserController::class, 'table_user']);

