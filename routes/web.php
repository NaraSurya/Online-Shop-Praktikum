<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');;

Auth::routes();
Route::get('user/logout','Auth\LoginController@logoutUser')->name('user.logout');

Route::group(['prefix' => 'admin'], function () {
    Route::get('login','AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login','AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::get('logout','AuthAdmin\LoginController@logout')->name('admin.logout');
    Route::get('register','AdminController@create')->name('admin.create');
    Route::post('register','AdminController@store')->name('admin.store');
    Route::get('catProduct','produk@catProduct')->name('admin.catProduct');
    Route::get('tambahCatProduct','produk@tambahCatProduct')->name('admin.tambahCatProduct');
    Route::get('storeCatProduct','produk@storeCatProduct')->name('admin.storeCatProduct');
    Route::get('Product','produk@Product')->name('admin.Product');
    Route::get('tambahProduct','produk@tambahProduct')->name('admin.tambahProduct');
    Route::post('storeTambProduct','produk@storeTambProduct')->name('admin.storeTambProduct');
    Route::get('detailCatProduct','produk@detailCatProduct')->name('admin.detailCatProduct');
    Route::get('editProduct/{id}','produk@editProduct');
    Route::get('tambahDetailCatProduct','produk@tambahDetailCatProduct')->name('admin.tambahDetailCatProduct');
    Route::post('storeEditProduct','produk@storeEditProduct')->name('admin.storeEditProduct');
});

Route::group(['prefix' => 'midtest'], function () {
    Route::get('/','midtest@dataMahasiswa')->name('admin.dataMahasiswa');
    Route::post('Storetambah','midtest@Storetambah')->name('admin.Storetambah');
    Route::get('tambah','midtest@tambah')->name('admin.tambah');
    Route::get('editMahasiswa/{id}','midtest@editMahasiswa');
    Route::get('hapusMahasiswa/{id}','midtest@hapusMahasiswa');
    Route::post('storeEditMahasiswa','midtest@storeEditMahasiswa')->name('admin.storeEditMahasiswa');
    
});


Route::group(['prefix' => 'user'], function () {
    Route::get('/product/{id}','HomeController@product')->name('user.product');
});
// Route::get('test', function () {
//     event(new App\Events\StatusLiked('Someone'));
//     return "Event has been sent!";
// });
// Route::get('send', 'midtest@sendNotification');


