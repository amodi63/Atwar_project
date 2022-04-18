<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    Route::group(['namespace' => 'Dashboard', 'middleware' =>'auth:admin', 'prefix' => 'admin'], function (){

        Route::get('index','DashboardController@index')->name('admin.dashboard');
        Route::get('logout','LoginController@logout')->name('admin.logout');


        ######################### Profile Routes #############################################################

        Route::group(['prefix' => 'profile'], function (){
            Route::get('edit', 'ProfileController@edit')->name('edit.profile');
            Route::put('update', 'ProfileController@update')->name('update.profile');
        });

        ######################### End Profile Routes #############################################################

        ######################### Orders Routes #############################################################

        Route::group(['prefix' => 'orders'], function (){
            Route::get('/', 'OrderController@index')->name('orders');
            Route::get('/show/{id}', 'OrderController@show')->name('show.order');
            Route::post('/change-status', 'OrderController@changeStatus')->name('changeStatus.order');
        });

        ######################### End Orders Routes #############################################################

        ######################### ContactUS Routes #############################################################

        Route::group(['prefix' => 'contact-us'], function (){
            Route::get('/', 'ContactUsController@index')->name('contactus');
        });

        ######################### End ContactUS Routes #############################################################

        ##################  Slider Routes #############################################################

        Route::group(['prefix' => 'slider'], function (){
            Route::get('/show-slider', 'SliderController@index')->name('index.sliders');
            Route::post('save', 'SliderController@saveImagesOfSliderInDB')->name('save.slider');
            Route::get('edit/{id}', 'SliderController@edit')->name('edit.slider');
            Route::post('update/{id}', 'SliderController@update')->name('update.slider');
            Route::get('delete/{id}', 'SliderController@destroy')->name('delete.slider');

            Route::post('save-images-slider-inFolder', 'SliderController@saveImagesOfSliderInFolder')->name('save.images.slider.inFolder');
            Route::get('delete-image-slider', 'SliderController@deleteImagesOfSlider')->name('delete.slider.image');
        });
        ######################### End Slider Routes #############################################################

        ##################  AboutUs Routes #############################################################

        Route::group(['prefix' => 'users-dashboard'], function (){
            Route::get('', 'UsersDashboardController@index')->name('index.users');
            Route::post('save', 'UsersDashboardController@store')->name('save.user');
            Route::get('edit/{id}', 'UsersDashboardController@edit')->name('edit.user');
            Route::post('update/{id}', 'UsersDashboardController@update')->name('update.user');
            Route::get('delete', 'UsersDashboardController@destroy')->name('delete.user');

        });
        ######################### End AboutUs Routes #############################################################

        ##################  AboutUs Routes #############################################################

        Route::group(['prefix' => 'about-us'], function (){
            Route::get('/show-about-us', 'AboutUsController@index')->name('index.about_us');
            Route::post('save', 'AboutUsController@store')->name('save.about_us');
            Route::get('edit/{id}', 'AboutUsController@edit')->name('edit.about_us');
            Route::post('update/{id}', 'AboutUsController@update')->name('update.about_us');
            Route::get('delete/{id}', 'AboutUsController@destroy')->name('delete.about_us');

        });
        ######################### End AboutUs Routes #############################################################

        ##################  News Tap Routes #############################################################

        Route::group(['prefix' => 'news-tap'], function (){
            Route::get('/show-news-tap', 'NewsTapController@index')->name('index.news_tap');
            Route::post('save', 'NewsTapController@store')->name('save.news_tap');
            Route::get('edit/{id}', 'NewsTapController@edit')->name('edit.news_tap');
            Route::post('update/{id}', 'NewsTapController@update')->name('update.news_tap');
            Route::get('delete/{id}', 'NewsTapController@destroy')->name('delete.news_tap');

        });
        ######################### End News Tap Routes #############################################################

        ##################  Blog Routes #############################################################

        Route::group(['prefix' => 'blog'], function (){
            Route::get('/show-blog', 'BlogController@index')->name('index.blog');
            Route::post('save', 'BlogController@store')->name('save.blog');
            Route::get('edit/{id}', 'BlogController@edit')->name('edit.blog');
            Route::post('update/{id}', 'BlogController@update')->name('update.blog');
            Route::get('delete/{id}', 'BlogController@destroy')->name('delete.blog');

        });
        ######################### End Blog Routes #############################################################

        ##################  Partner Routes #############################################################

        Route::group(['prefix' => 'partner'], function (){
            Route::get('/show', 'PartnerController@index')->name('index.partner');
            Route::post('save', 'PartnerController@store')->name('save.partner');
            Route::get('edit/{id}', 'PartnerController@edit')->name('edit.partner');
            Route::post('update/{id}', 'PartnerController@update')->name('update.partner');
            Route::get('delete/{id}', 'PartnerController@destroy')->name('delete.partner');

        });
        ######################### End Partner Routes #############################################################

        ##################  Main Partner Routes #############################################################

        Route::group(['prefix' => 'main-partner'], function (){
            Route::get('/show', 'MainPartnerController@index')->name('index.main_partner');
            Route::post('save', 'MainPartnerController@store')->name('save.main_partner');
            Route::get('edit/{id}', 'MainPartnerController@edit')->name('edit.main_partner');
            Route::post('update/{id}', 'MainPartnerController@update')->name('update.main_partner');
            Route::get('delete/{id}', 'MainPartnerController@destroy')->name('delete.main_partner');

        });
        ######################### End Main Partner Routes #############################################################

        ##################  Blog Routes #############################################################

        Route::group(['prefix' => 'coordinates'], function (){
            Route::get('/show', 'CoordinatesController@index')->name('index.coordinates');
            Route::post('save', 'CoordinatesController@store')->name('save.coordinates');
            Route::get('edit/{id}', 'CoordinatesController@edit')->name('edit.coordinates');
            Route::post('update/{id}', 'CoordinatesController@update')->name('update.coordinates');
            Route::get('delete/{id}', 'CoordinatesController@destroy')->name('delete.coordinates');

        });
        ######################### End Blog Routes #############################################################

        ##################  Service Routes #############################################################

        Route::group(['prefix' => 'service'], function (){
            Route::get('/show-service', 'ServiceController@index')->name('index.service');
            Route::post('save', 'ServiceController@store')->name('save.service');
            Route::get('edit/{id}', 'ServiceController@edit')->name('edit.service');
            Route::post('update/{id}', 'ServiceController@update')->name('update.service');
            Route::get('delete/{id}', 'ServiceController@destroy')->name('delete.service');

        });
        ######################### End Service Routes #############################################################

        ##################  Category Routes #############################################################

        Route::group(['prefix' => 'category'], function (){
            Route::get('/show-category', 'CategoryController@index')->name('index.category');
            Route::post('save', 'CategoryController@store')->name('save.category');
            Route::get('edit/{id}', 'CategoryController@edit')->name('edit.category');
            Route::post('update/{id}', 'CategoryController@update')->name('update.category');
            Route::get('delete/{id}', 'CategoryController@destroy')->name('delete.category');

        });
        ######################### End Category Routes #############################################################

        ##################  Company Routes #############################################################

        Route::group(['prefix' => 'company'], function (){
            Route::get('/show-company', 'CompanyController@index')->name('index.company');
            Route::post('save', 'CompanyController@store')->name('save.company');
            Route::get('edit/{id}', 'CompanyController@edit')->name('edit.company');
            Route::post('update/{id}', 'CompanyController@update')->name('update.company');
            Route::get('delete/{id}', 'CompanyController@destroy')->name('delete.company');

        });
        ######################### End Company Routes #############################################################

        ##################  Model Routes #############################################################

        Route::group(['prefix' => 'model'], function (){
            Route::get('/show-model', 'ModelController@index')->name('index.model');
            Route::post('save', 'ModelController@store')->name('save.model');
            Route::get('edit/{id}', 'ModelController@edit')->name('edit.model');
            Route::post('update/{id}', 'ModelController@update')->name('update.model');
            Route::get('delete/{id}', 'ModelController@destroy')->name('delete.model');

        });
        ######################### End Model Routes #############################################################

        ##################  ContactInformation Routes #############################################################

        Route::group(['prefix' => 'contact-information'], function (){
            Route::get('/show', 'ContactInformationController@index')->name('index.contact_information');
            Route::post('save', 'ContactInformationController@store')->name('save.contact_information');
            Route::get('edit/{id}', 'ContactInformationController@edit')->name('edit.contact_information');
            Route::post('update/{id}', 'ContactInformationController@update')->name('update.contact_information');
            Route::get('delete/{id}', 'ContactInformationController@destroy')->name('delete.contact_information');

        });
        ######################### End ContactInformation Routes #############################################################

        ##################  UsefulLink Routes #############################################################

        Route::group(['prefix' => 'useful-links'], function (){
            Route::get('/show', 'UsefulLinkController@index')->name('index.useful_links');
            Route::post('save', 'UsefulLinkController@store')->name('save.useful_links');
            Route::get('edit/{id}', 'UsefulLinkController@edit')->name('edit.useful_links');
            Route::post('update/{id}', 'UsefulLinkController@update')->name('update.useful_links');
            Route::get('delete/{id}', 'UsefulLinkController@destroy')->name('delete.useful_links');

        });
        ######################### End UsefulLink Routes #############################################################

        ##################  SocialLink Routes #############################################################

        Route::group(['prefix' => 'social-link'], function (){
            Route::get('/show', 'SocialLinkController@index')->name('index.social_link');
            Route::post('save', 'SocialLinkController@store')->name('save.social_link');
            Route::get('edit/{id}', 'SocialLinkController@edit')->name('edit.social_link');
            Route::post('update/{id}', 'SocialLinkController@update')->name('update.social_link');
            Route::get('delete/{id}', 'SocialLinkController@destroy')->name('delete.social_link');

        });
        ######################### End SocialLink Routes #############################################################

        ##################  Tax Routes #############################################################

        Route::group(['prefix' => 'tax'], function (){
            Route::get('/show-tax', 'TaxController@index')->name('index.tax');
            Route::post('save', 'TaxController@store')->name('save.tax');
            Route::get('edit/{id}', 'TaxController@edit')->name('edit.tax');
            Route::post('update/{id}', 'TaxController@update')->name('update.tax');
            Route::get('delete/{id}', 'TaxController@destroy')->name('delete.tax');

        });
        ######################### End Tax Routes #############################################################

        ##################  Coupon Routes #############################################################

        Route::group(['prefix' => 'coupon'], function (){
            Route::get('/show-coupon', 'CouponController@index')->name('index.coupon');
            Route::post('save', 'CouponController@store')->name('save.coupon');
            Route::get('edit/{id}', 'CouponController@edit')->name('edit.coupon');
            Route::post('update/{id}', 'CouponController@update')->name('update.coupon');
            Route::post('status/update', 'CouponController@updateStatus')->name('updateStatus.coupon');
            Route::get('delete/{id}', 'CouponController@destroy')->name('delete.coupon');
        });
        ######################### End Coupon Routes ############################################################

        ##################  Product Routes #############################################################

        Route::group(['prefix' => 'product'], function (){
            Route::get('/show-product', 'ProductController@index')->name('index.product');
            Route::post('save', 'ProductController@store')->name('save.product');
            Route::get('create', 'ProductController@create')->name('create.product');
            Route::get('edit/{id}', 'ProductController@edit')->name('edit.product');
            Route::post('update/{id}', 'ProductController@update')->name('update.product');
            Route::get('delete/{id}', 'ProductController@destroy')->name('delete.product');
            Route::get('add-product-images/{product_id}', 'ProductController@addProductImages')->name('add.product.images');
            Route::post('save-images-inFolder', 'ProductController@saveImagesOfProductInFolder')->name('save.images.inFolder');
            Route::post('save-images-inDB', 'ProductController@saveImagesOfProductInDB')->name('save.images.inDB');
            Route::get('delete-image', 'ProductController@deleteImagesOfProduct')->name('delete.image');
            Route::post('remove-image', 'ProductController@removeImagesOfProductFromFolder')->name('delete.image.fromFolder');
        });
        ######################### End Product Routes ############################################################



    });

    Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin', 'prefix' => 'admin'], function(){
        Route::get('/login','LoginController@login')->name('admin.login.page');
        Route::get('/','LoginController@redirectLogin')->name('redirectLogin');
        Route::post('/check-login','LoginController@checkLogin')->name('check.admin.login');
    });
});

