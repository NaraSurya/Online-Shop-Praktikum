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
<<<<<<< HEAD

Route::get('/', 'HomeController@index')->name('home');;
=======
use App\User;
use App\Notifications\NewItem;
Route::get('/', function () {
    return view('welcome');
});
>>>>>>> 16cf9c755f929b3623735832f72982723f4ec32d

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
    Route::get('tambahCourier','produk@tambahCourier')->name('admin.dataCourier');
    Route::get('tambahCourierBaru','produk@tambahCourierBaru')->name('admin.tambahCourier');
    Route::get('storeCourier','produk@storeCourier')->name('admin.storeCourier');
    Route::get('editCourier/{id}','produk@editCourier');
    Route::get('storeEditCourier','produk@storeEditCourier')->name('admin.storeEditCourier');
    Route::get('markReadAdmin','produk@markReadAdmin')->name('admin.markReadAdmin');
    
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
    Route::get('/cart/{flag}/{id}','CartController@addRemoveCart')->name('cart.addRemove');
    Route::get('/cart','cartController@index')->name('cart');
    Route::get('/qtycart/{id}/{qty}','cartController@updateQuantity')->name('cart.qty');
    Route::post('/detailCart','cartController@detailCart')->name('cart.detail');
    Route::delete('/deleteCart/{id}','cartController@deleteCart')->name('cart.delete');
    Route::post('/buyCart','cartController@buy')->name('cart.buy');

    Route::get('/transaction','TransactionController@index')->name('transaction');
    Route::get('/transaction/{id}','TransactionController@show')->name('transaction.show');
    Route::post('/transaction/{id}/proof_of_payment','TransactionController@postPayment')->name('transaction.postPayment');
    Route::get('/buyForm/{id}','BuyController@buyItem')->name('buy.form');
    Route::post('/buy/{id}','BuyController@buy')->name('buy');
    // Route::get('/buy/{id}','cartController@buyDirect')->name('buy');
});
// Route::get('test', function () {
//     event(new App\Events\StatusLiked('Someone'));
//     return "Event has been sent!";
// });
// Route::get('send', 'midtest@sendNotification');

Route::group(['prefix' => 'raja-ongkir'], function () {
    Route::get('/get-provinsi','RajaOngkirController@getProvinsi')->name('raja_ongkir.get_provinsi');
    Route::get('/get-city','RajaOngkirController@getCity')->name('raja_ongkir.get_city');
    Route::get('/checkshipping','RajaOngkirController@checkShipping')->name('raja_ongkir.checkShipping');

});

// Route::get('/get-provinsi','RajaOngkirController@getProvinsi')->name('raja.getProvinsi);

