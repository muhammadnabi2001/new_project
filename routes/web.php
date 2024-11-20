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
    Route::get('users',[UserController::class,'user'])->name('users')->middleware(Check::class.':admin');
    Route::get('usercreate',[UserController::class,'usercreate'])->name('usercreate')->middleware(Check::class.':admin');
    Route::get('useredit{user}',[UserController::class,'useredit'])->name('useredit');
    Route::post('userupdate{user}',[UserController::class,'userupdate'])->name('userupdate')->middleware(Check::class.':admin');
    Route::post('userstore',[UserController::class,'userstore'])->name('userstore')->middleware(Check::class.':admin');
    Route::get('userdelete{user}',[UserController::class,'userdelete'])->name('userdelete')->middleware(Check::class.':admin');

    Route::get('categories',[CategoryController::class,'category'])->name('categories')->middleware(Check::class.':admin');
    Route::get('categorycreate',[CategoryController::class,'categorycreate'])->name('categorycreate')->middleware(Check::class.':admin');
    Route::post('categorystore',[CategoryController::class,'categorystore'])->name('categorystore')->middleware(Check::class.':admin');
    Route::get('categoryedit{category}',[CategoryController::class,'categoryedit'])->name('categoryedit')->middleware(Check::class.':admin');
    Route::post('categoryupdate{category}',[CategoryController::class,'categoryupdate'])->name('categoryupdate')->middleware(Check::class.':admin');
    Route::get('categorydelete{category}',[CategoryController::class,'categorydelete'])->name('categorydelete')->middleware(Check::class.':admin');

    Route::get('regions',[RegionController::class,'regions'])->name('regions')->middleware(Check::class.':admin');
    Route::get('regioncreate',[RegionController::class,'regioncreate'])->name('regioncreate')->middleware(Check::class.':admin');
    Route::post('regionstore',[RegionController::class,'regionstore'])->name('regionstore')->middleware(Check::class.':admin');
    Route::get('regionedit{region}',[RegionController::class,'regionedit'])->name('regionedit')->middleware(Check::class.':admin');
    Route::post('regionupdate{region}',[RegionController::class,'regionupdate'])->name('regionupdate')->middleware(Check::class.':admin');
    Route::get('regiondelete{region}',[RegionController::class,'regiondelete'])->name('regiondelete')->middleware(Check::class.':admin');

    Route::get('topshiriqlar',[TopshiriqController::class,'topshiriqlar'])->name('topshiriqlar')->middleware(Check::class.':admin');
    Route::get('topshiriqcreate',[TopshiriqController::class,'topshiriqcreate'])->name('topshiriqcreate')->middleware(Check::class.':admin');
    Route::post('topshiriqstore',[TopshiriqController::class,'topshiriqstore'])->name('topshiriqstore')->middleware(Check::class.':admin');
    Route::get('topshiriqedit/{topshiriq}',[TopshiriqController::class,'topshiriqedit'])->name('topshiriqedit')->middleware(Check::class.':admin');
    Route::post('topshiriqupdate/{topshiriq}',[TopshiriqController::class,'topshiriqupdate'])->name('topshiriqupdate')->middleware(Check::class.':admin');
    Route::get('topshiriqdelete/{regiontopshiriq}',[TopshiriqController::class,'topshiriqdelete'])->name('topshiriqdelete')->middleware(Check::class.':admin');
    Route::get('calculate/{day}',[TopshiriqController::class,'calculate'])->name('calculate');
    Route::get('accept/{topshiriq}/{id}',[TopshiriqController::class,'accept'])->name('accept');
    Route::get('filtr',[TopshiriqController::class,'filtr'])->name('filtr');
    Route::get('boshqaruv',[TopshiriqController::class,'boshqaruv'])->name('boshqaruv');
    Route::get('detail/{regionId}/{categoryId}',[TopshiriqController::class,'detail'])->name('detail');

    Route::get('vazifa',[JavobController::class,'vazifa'])->name('vazifa')->middleware(Check::class.':user');
    Route::get('usertopshiriq/{day}',[JavobController::class,'usertopshiriq'])->name('usertopshiriq')->middleware(Check::class.':user');
    Route::get('view/{topshiriq}',[JavobController::class,'view'])->name('view')->middleware(Check::class.':user');
    Route::post('bajarish/{topshiriq}',[JavobController::class,'bajarish'])->name('bajarish')->middleware(Check::class.':user');
    Route::get('sort',[JavobController::class,'sort'])->name('sort')->middleware(Check::class.':user');
    Route::get('natija',[JavobController::class,'natija'])->name('natija')->middleware(Check::class.':admin');
    Route::get('filtrnatija',[JavobController::class,'filtrnatija'])->name('filtrnatija')->middleware(Check::class.':user');
    Route::get('qabul{javob}',[JavobController::class,'qabul'])->name('qabul')->middleware(Check::class.':admin');
    Route::post('reject{javob}',[JavobController::class,'reject'])->name('reject')->middleware(Check::class.':admin');

