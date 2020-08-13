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
Route::view('/','welcome')->name('home');



Route::get('/home','homeController@index');
Auth::routes();

Route::get('/meals', function () {
    return redirect('/meals');
});
Route::resource('/meals','MealsController');





Route::get('/booking', function () {
    return redirect('/booking');
});
Route::resource('/booking','BookingsController');

Route::get('/admin', function () {
    return redirect('/admin');
});

Route::resource('/admin','UserController');

Route::get('/order', function () {
    return redirect('/order');
});
Route::resource('/order','OrdersController');

Route::get('/panier','CartController@index')->name('cart.index');
Route::post('/panier/ajoute','CartController@store')->name('cart.store');
Route::delete('/panier/{rowId}','CartController@destroy')->name('cart.destroy');
//mettre a jour les quantités 
Route::patch('/panier/{rowId}','CartController@update')->name('cart.update');

Route::get('/videpanier', function(){
 Cart::destroy();
});

Route::get('/payement', function () {
    return redirect('/payement');
});
Route::resource('/payement','PayementController');
/*
Route::get('/payement','PayementController@index')->name('payement.index');
Route::post('/payement','PayementController@store')->name('payement.store');*/
Route::get('/merci',function(){
	return view('payement.thinkyou');
});

  






//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('meals/index','MealsController@index');
//Route::get('meals/create','MealsController@create');
//Route::get('meals/store','MealsController@store');



