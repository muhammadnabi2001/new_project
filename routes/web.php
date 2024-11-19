<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JavobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\TopshiriqController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Check;
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

    Route::get('topshiriqlar',[TopshiriqController::class,'topshiriqlar'])->name('topshiriqlar')->middleware(Check::class.':admin');
    Route::get('topshiriqcreate',[TopshiriqController::class,'topshiriqcreate'])->name('topshiriqcreate')->middleware(Check::class.':admin');
    Route::post('topshiriqstore',[TopshiriqController::class,'topshiriqstore'])->name('topshiriqstore')->middleware(Check::class.':admin');
    Route::get('topshiriqedit/{topshiriq}',[TopshiriqController::class,'topshiriqedit'])->name('topshiriqedit')->middleware(Check::class.':admin');
    Route::post('topshiriqupdate/{topshiriq}',[TopshiriqController::class,'topshiriqupdate'])->name('topshiriqupdate')->middleware(Check::class.':admin');
    Route::get('topshiriqdelete/{id}',[TopshiriqController::class,'topshiriqdelete'])->name('topshiriqdelete')->middleware(Check::class.':admin');
    Route::get('calculate/{day}',[TopshiriqController::class,'calculate'])->name('calculate');
    Route::get('accept/{topshiriq}/{id}',[TopshiriqController::class,'accept'])->name('accept');
    Route::get('filtr',[TopshiriqController::class,'filtr'])->name('filtr');

    Route::get('vazifa',[JavobController::class,'vazifa'])->name('vazifa');
    Route::get('usertopshiriq/{day}',[JavobController::class,'usertopshiriq'])->name('usertopshiriq');
    Route::get('view/{topshiriq}',[JavobController::class,'view'])->name('view');
    Route::post('bajarish/{topshiriq}',[JavobController::class,'bajarish'])->name('bajarish');
    Route::get('sort',[JavobController::class,'sort'])->name('sort');
    Route::get('natija',[JavobController::class,'natija'])->name('natija');
    Route::get('filtrnatija',[JavobController::class,'filtrnatija'])->name('filtrnatija');
