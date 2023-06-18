<?php

use \Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StripeController;
Route::get('/','front\indexController@index')->name('index');
Route::get('/kategori/{selflink}','front\cat\indexController@index')->name('cat');
Route::get('/yayin/{selflink}','front\yayin\indexController@index')->name('yayin');
Route::get('/search','front\search\indexController@index')->name('search');
Route::get('/kitap/detay/{selflink}','front\kitap\indexController@index')->name('kitap.detay');
Route::get('/sepet','front\sepet\indexController@index')->name('sepet.index')->middleware(['auth']);
Route::get('/sepet/add/{id}','front\sepet\indexController@add')->name('sepet.add')->middleware(['auth']);
Route::get('/sepet/remove/{id}','front\sepet\indexController@remove')->name('sepet.remove')->middleware(['auth']);
Route::get('/sepet/flush','front\sepet\indexController@flush')->name('sepet.flush');
Route::delete('/sepet/flush', 'front\sepet\indexController@flush')->name('sepet.flush');
Route::get('/sepet/complete','front\sepet\indexController@complete')->name('sepet.complete')->middleware(['auth']);
Route::get('/sepet/complete/kartbilgileri','front\sepet\indexController@kartbil')->name('sepet.kartBilgileri')->middleware(['auth']);
Route::post('/sepet/complete','front\sepet\indexController@completeStore')->name('sepet.completeStore')->middleware(['auth']);
Route::get('/profil', 'front\profil\indexController@index')->name('profil.index')->middleware(['auth']);
Route::post('/profil', 'front\profil\indexController@update')->name('profil.update')->middleware(['auth']);
Route::get('/begendiklerim','front\begen\indexController@index')->name('begen.index')->middleware(['auth']);
Route::get('/begendiklerim/add/{id}','front\begen\indexController@add')->name('begen.add')->middleware(['auth']);
Route::get('/begendiklerim/remove/{id}','front\begen\indexController@remove')->name('begen.remove')->middleware(['auth']);
Route::delete('/begen/flush', 'front\begen\indexController@flush')->name('begen.flush');
Route::get('/siparislerim', 'front\order\indexController@index')->name('order.index')->middleware(['auth']);
Route::get('/siparislerim/detail/{id}', 'front\order\indexController@detail')->name('order.detail')->middleware(['auth']);
Route::get('/siparislerim/cancel/{id}', 'front\order\indexController@cancel')->name('order.cancel')->middleware(['auth']);

/*Route::get('/send-mail', function () {

    $user = [
        'title' => 'Bu Mail VedatKurtay.com tarafından gönderilmiştir.',
        'body' => 'Bu bir test mailidir.'
    ];

    \Mail::to('alacakkisininmailadresi@gmail.com')->send(new \App\Mail\KullaniciKayitMail($user));

    dd("Email gönderildi!");
});*/

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['namespace'=>'admin','prefix'=>'admin','as'=>'admin.','middleware'=>['auth','AdminCtrl']],function (){

    Route::get('/','indexController@index')->name('index');
    Route::get('/search','search\indexController@index')->name('search');

    Route::group(['namespace'=>'yayinevi','prefix'=>'yayinevi','as'=>'yayinevi.'],function (){

        Route::get('/', 'indexController@index')->name('index');
        Route::get('/ekle', 'indexController@create')->name('create');
        Route::post('/ekle', 'indexController@store')->name('create.post');
        Route::get('/düzenle/{id}','indexController@edit')->name('edit');
        Route::post('/düzenle/{id}','indexController@update')->name('edit.post');
        Route::get('/sil/{id}','indexController@delete')->name('delete');

    });
    Route::group(['namespace'=>'yazar','prefix'=>'yazar','as'=>'yazar.'],function (){

        Route::get('/', 'indexController@index')->name('index');
        Route::get('/ekle', 'indexController@create')->name('create');
        Route::post('/ekle', 'indexController@store')->name('create.post');
        Route::get('/düzenle/{id}','indexController@edit')->name('edit');
        Route::post('/düzenle/{id}','indexController@update')->name('edit.post');
        Route::get('/sil/{id}','indexController@delete')->name('delete');

    });
    Route::group(['namespace'=>'kitap','prefix'=>'kitap','as'=>'kitap.'],function (){

        Route::get('/', 'indexController@index')->name('index');
        Route::get('/ekle', 'indexController@create')->name('create');
        Route::post('/ekle', 'indexController@store')->name('create.post');
        Route::get('/düzenle/{id}','indexController@edit')->name('edit');
        Route::post('/düzenle/{id}','indexController@update')->name('edit.post');
        Route::get('/sil/{id}','indexController@delete')->name('delete');

    });
    Route::group(['namespace'=>'kategori','prefix'=>'kategori','as'=>'kategori.'],function (){

        Route::get('/', 'indexController@index')->name('index');
        Route::get('/ekle', 'indexController@create')->name('create');
        Route::post('/ekle', 'indexController@store')->name('create.post');
        Route::get('/düzenle/{id}','indexController@edit')->name('edit');
        Route::post('/düzenle/{id}','indexController@update')->name('edit.post');
        Route::get('/sil/{id}','indexController@delete')->name('delete');

    });
    Route::group(['namespace'=>'slider','prefix'=>'slider','as'=>'slider.'],function (){

        Route::get('/', 'indexController@index')->name('index');
        Route::get('/ekle', 'indexController@create')->name('create');
        Route::post('/ekle', 'indexController@store')->name('create.post');
        Route::get('/düzenle/{id}','indexController@edit')->name('edit');
        Route::post('/düzenle/{id}','indexController@update')->name('edit.post');
        Route::get('/sil/{id}','indexController@delete')->name('delete');

    });
    Route::group(['namespace'=>'order','prefix'=>'order','as'=>'order.'],function (){

        Route::get('/', 'indexController@index')->name('index');
        Route::get('/ekle', 'indexController@create')->name('create');
        Route::post('/ekle', 'indexController@store')->name('create.post');
        Route::get('/detail/{id}','indexController@detail')->name('detail');
        Route::get('/sil/{id}','indexController@delete')->name('delete');

    });
});
