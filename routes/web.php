<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\Dashboard;
USE App\Http\Controllers\Back\ArticleController;
// ---------------------
// Backend Routes
// ---------------------

Route::get('site-bakımda',function(){
    return view('front.offline');

});
// Giriş sayfası sadece giriş yapmamış kullanıcılar için
Route::middleware('isLogin')->name('admin.')->group(function () {
    Route::get('giris', [AuthController::class, 'login'])->name('login');
    Route::post('giris', [AuthController::class, 'loginPost'])->name('login.post');
});

// Admin panel ve çıkış işlemleri
Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
    // Articles
    // web.php
    Route::get('/profile', [Dashboard::class, 'profile'])->name('profile');

    Route::get('panel', [Dashboard::class, 'index'])->name('dashboard');
    Route::get('mesajlar',[App\Http\Controllers\Back\MessageController::class,'index'])->name('message');
    Route::get('mesajlar/sil/{id}',[App\Http\Controllers\Back\MessageController::class,'delete'])->name('message.delete');

    Route::get('makaleler/silinenler' ,[App\Http\Controllers\Back\ArticleController::class, 'trashed'])->name('makaleler.trashed');
    Route::resource('makaleler', 'App\Http\Controllers\Back\ArticleController');
    Route::get('/switch', [App\Http\Controllers\Back\ArticleController::class, 'switch'])->name('switch');
    Route::get('/deletearticle/{id}', [App\Http\Controllers\Back\ArticleController::class, 'delete'])->name('delete.article');
    Route::get('/harddeletearticle/{id}', [App\Http\Controllers\Back\ArticleController::class, 'hardDelete'])->name('hard.delete.article');
    Route::get('/recoverarticle/{id}', [App\Http\Controllers\Back\ArticleController::class, 'recover'])->name('recover.article');

    // Categoriler
    Route::get('kategori/durum', [App\Http\Controllers\Back\CategoryController::class, 'switch'])->name('category.switch');
    Route::get('kategoriler', [App\Http\Controllers\Back\CategoryController::class, 'index'])->name('category.index');
    Route::post('kategori/olustur', [App\Http\Controllers\Back\CategoryController::class, 'create'])->name('category.create');
    Route::post('kategori/guncelle', [App\Http\Controllers\Back\CategoryController::class, 'update'])->name('category.update');
    Route::get('kategori/getdata', [App\Http\Controllers\Back\CategoryController::class, 'getData'])->name('category.getdata');
    Route::post('kategori/sil', [App\Http\Controllers\Back\CategoryController::class, 'delete'])->name('category.delete');
    // Sayfalar
    Route::get('/sayfalar', [App\Http\Controllers\Back\PageController::class, 'index'])->name('page.index');
    Route::get('page/switch', [App\Http\Controllers\Back\PageController::class, 'switch'])->name('page.switch');
    Route::get('/sayfa/duzenle/{id}', [App\Http\Controllers\Back\PageController::class, 'edit'])->name('page.edit');
    Route::put('/sayfa/guncelle/{id}', [App\Http\Controllers\Back\PageController::class, 'update'])->name('page.update');
    Route::get('/sayfalar/olustur', [App\Http\Controllers\Back\PageController::class, 'create'])->name('page.create');
    Route::post('/sayfalar/olustur', [App\Http\Controllers\Back\PageController::class, 'store'])->name('page.store');
    Route::get('/sayfa/sil/{id}', [App\Http\Controllers\Back\PageController::class, 'delete'])->name('page.delete');
    Route::get('/sayfa/siralama', [App\Http\Controllers\Back\PageController::class, 'orders'])->name('page.orders');





    // Çıkış işlemi
    Route::get('cikis', [AuthController::class, 'logout'])->name('logout');
    Route::get('/ayarlar', [App\Http\Controllers\Back\ConfigController::class, 'index'])->name('config.index');
    Route::post('/güncelleme', [App\Http\Controllers\Back\ConfigController::class, 'update'])->name('config.update');



});

//Fronted routes
Route::get('/', [App\Http\Controllers\Front\Homepage::class, 'index'])->name('homepage');
Route::get('/iletisim', 'App\Http\Controllers\Front\Homepage@contact')->name('contact');
Route::post('/iletisim','App\Http\Controllers\Front\Homepage@contactpost')->name('contact.post');
Route::get('/kategori/{category}','App\Http\Controllers\Front\Homepage@category')->name('category');
Route::get('/{category}/{slug}', 'App\Http\Controllers\Front\Homepage@single')->name('single');


Route::get('/{sayfa}', 'App\Http\Controllers\Front\Homepage@page')->name('page');

