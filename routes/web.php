<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    Route::get('mainpage',[ProfileController::class,'mainpage'])->name('mainpage');
    Route::get('users',[UserController::class,'user'])->name('users');
    Route::get('usercreate',[UserController::class,'usercreate'])->name('usercreate');
    Route::get('useredit{user}',[UserController::class,'useredit'])->name('useredit');
    Route::post('userupdate{user}',[UserController::class,'userupdate'])->name('userupdate');
    Route::post('userstore',[UserController::class,'userstore'])->name('userstore');
    Route::get('userdelete{user}',[UserController::class,'userdelete'])->name('userdelete');

    Route::get('categories',[CategoryController::class,'category'])->name('categories');
    Route::get('categorycreate',[CategoryController::class,'categorycreate'])->name('categorycreate');
    Route::post('categorystore',[CategoryController::class,'categorystore'])->name('categorystore');
    Route::get('categoryedit{category}',[CategoryController::class,'categoryedit'])->name('categoryedit');
    Route::post('categoryupdate{category}',[CategoryController::class,'categoryupdate'])->name('categoryupdate');
    Route::get('categorydelete{category}',[CategoryController::class,'categorydelete'])->name('categorydelete');

    Route::get('regions',[RegionController::class,'regions'])->name('regions');
    Route::get('regioncreate',[RegionController::class,'regioncreate'])->name('regioncreate');
    Route::post('regionstore',[RegionController::class,'regionstore'])->name('regionstore');
    Route::get('regionedit{region}',[RegionController::class,'regionedit'])->name('regionedit');
    Route::post('regionupdate{region}',[RegionController::class,'regionupdate'])->name('regionupdate');
    Route::get('regiondelete{region}',[RegionController::class,'regiondelete'])->name('regiondelete');
