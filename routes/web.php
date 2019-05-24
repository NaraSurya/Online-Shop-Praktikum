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
use App\User;
use App\Notifications\NewItem;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
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
    Route::get('editCategory/{id}','produk@editCategory');
    Route::get('tambahDetailCatProduct','produk@tambahDetailCatProduct')->name('admin.tambahDetailCatProduct');
    Route::post('storeEditProduct','produk@storeEditProduct')->name('admin.storeEditProduct');
    Route::get('tambahCourier','produk@tambahCourier')->name('admin.dataCourier');
    Route::get('tambahCourierBaru','produk@tambahCourierBaru')->name('admin.tambahCourier');
    Route::get('storeCourier','produk@storeCourier')->name('admin.storeCourier');
    Route::get('editCourier/{id}','produk@editCourier');
    Route::get('storeEditCourier','produk@storeEditCourier')->name('admin.storeEditCourier');
    Route::get('markReadAdmin','produk@markReadAdmin')->name('admin.markReadAdmin');
    Route::get('storeEditCategory','produk@storeEditCategory')->name('admin.storeEditCategory');
    Route::get('index','produk@index')->name('admin.index');
    Route::get('prosesTransaksi','produk@prosesTransaksi')->name('admin.transaction');
    Route::get('verifikasi/{id}','produk@verifikasi');

 
    
});

Route::group(['prefix' => 'midtest'], function () {
    Route::get('/','midtest@dataMahasiswa')->name('admin.dataMahasiswa');
    Route::post('Storetambah','midtest@Storetambah')->name('admin.Storetambah');
    Route::get('tambah','midtest@tambah')->name('admin.tambah');
    Route::get('editMahasiswa/{id}','midtest@editMahasiswa');
    Route::get('hapusMahasiswa/{id}','midtest@hapusMahasiswa');
    Route::post('storeEditMahasiswa','midtest@storeEditMahasiswa')->name('admin.storeEditMahasiswa');
    
});
Route::GET('test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "Event has been sent!";
});
Route::get('send', 'midtest@sendNotification');






