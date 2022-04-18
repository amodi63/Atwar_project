<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    Route::group(['namespace' => 'Site'], function (){
        Route::get('/','HomeController@home')->name('home');
        Route::get('/open-modal','HomeController@openModal')->name('openModal');
        Route::get('/about-us','AboutUsController@aboutUs')->name('about_us');
        Route::get('/service','ServiceController@service')->name('service');
        Route::get('/service-details/{id}','ServiceController@serviceDetails')->name('service.details');
        Route::get('/blog','BlogController@blog')->name('blog');
        Route::get('/blog-details/{id}','BlogController@blogDetails')->name('blog.details');
        Route::get('/bill-pending','BillBendingController@billPending')->name('bill_pending');
        Route::get('/cart','CartController@cart')->name('cart');
        Route::get('/contact-us','ContactUsController@contactUs')->name('contact_us');
        Route::post('/send-contact-us','ContactUsController@sendContactUs')->name('sendContactUs');
        Route::get('/product-details/{id}','ShopController@productDetails')->name('product_details');
        Route::post('add-product-to-cart','CartController@addProductToCart')->name('addProductToCart');
        Route::post('update-product-quantity','CartController@productUpdateQuantity')->name('ProductUpdateQuantity');
        Route::post('shipping','CartController@shipping')->name('shipping');
        Route::delete('delete-product','CartController@productDelete')->name('ProductDelete');
        Route::get('/shop','ShopController@shop')->name('shop');
        Route::get('/shop-filter','ShopController@shopFilter')->name('shopFilter');
        Route::get('/user-order','UserOrderController@userOrder')->name('user_order');

        Route::post('logout','CustomerController@logout')->name('logout');

    });




    Route::group(['namespace' => 'Site', 'middleware' => 'guest:customer'], function(){
        //Route::get('/register','CustomerController@register')->name('customer.register.page');
        Route::post('/register','CustomerController@registerCustomer')->name('customer.register');
        //Route::get('/login','CustomerController@login')->name('customer.login.page');
        Route::post('/check-login-customer','CustomerController@checkLoginCustomer')->name('check.customer.login');

//        Route::get('/password/reset','CustomerForgotPasswordController@showLinkRequestForm')->name('customer.password.request');
//        Route::get('/password/reset/{token}','CustomerRestPasswordController@showResetForm')->name('customer.password.reset');
//        Route::post('/password/email','CustomerForgotPasswordController@sendResetLinkEmail')->name('customer.password.email');
//        Route::post('/password/reset','CustomerRestPasswordController@reset')->name('customer.password.update');


        ///////////////  View Products Pages /////////////////////

        ///////////////  End View Products Pages /////////////////////

    });
});


