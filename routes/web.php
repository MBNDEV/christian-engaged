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

Route::group(['prefix' => 'manage'], function () {

    Route::group(['middleware' => ['general', 'prevent-back-history']], function () {
        Route::get('/login', 'AdminController@showLoginForm');
        Route::post('/login', 'AdminController@login');
    });
    Route::group(['middleware' => ['admin', 'prevent-back-history']], function () {

        Route::get('/dashboard', 'AdminController@dashboard');
        Route::get('/logout', 'AdminController@logout');

        /* User Route Start */
        Route::get('/users', 'UserController@index');

        Route::get('users/register', 'UserController@add');
        Route::post('users/register', 'UserController@save');

        Route::get('users/edit/{id}', 'UserController@edit');
        Route::post('users/edit/{id}', 'UserController@update');

        Route::get('users/delete/{id}', 'UserController@delete');
        Route::post('users/bulkUserUpdate', 'UserController@bulkUserUpdate');
        /* User Route End */

        /* Video topics Route Start */
        Route::get('/video-topics', 'VideoController@videotopics');
        Route::get('videotopics/add', 'VideoController@add');
        Route::post('videotopics/add', 'VideoController@save');
        Route::get('videotopics/edit/{id}', 'VideoController@edit');
        Route::post('videotopics/edit/{id}', 'VideoController@update');
        Route::get('videotopics/delete/{id}', 'VideoController@delete');
        Route::post('videotopics/topic-sort', 'VideoController@sort');
        /* Video topics Route End */

        Route::get('/newsletter/listing', 'NewsletterController@listing');
        Route::get('/newsletter/listing/{id}', 'NewsletterController@subscribe');
        Route::post('/newsletter/listing', 'NewsletterController@filterbydate');
        Route::post('/export', 'NewsletterController@export');
        Route::post('/exportnews', 'NewsletterController@exportnews');
        /* Email Template Route Start */
        Route::get('templates', 'TemplateController@index');
        Route::get('templates/edit/{id}', 'TemplateController@getTemplate');
        Route::post('templates/update/{id}', 'TemplateController@updateTemplate');
        /* Email Template Route End */


        Route::get('/cms', 'CmsController@index');
        Route::get('/cms/edit/{id}', 'CmsController@edit');
        Route::get('/cms/create', 'CmsController@create');
        Route::post('/cms/save', 'CmsController@save');
        Route::post('/cms/update/{id}', 'CmsController@update');
        Route::post('/cms/delete/{id}', 'CmsController@delete');
        Route::get('/contact_us/edit', 'CmsController@contactus');
        Route::post('/cms/save-contactus', 'CmsController@contactusedit');

        Route::get('/cms/about-us', 'CmsController@aboutus');
        Route::get('/cms/edit/about-us/{id}', 'CmsController@editaboutus');
        Route::post('/cms/edit/about-us/{id}', 'CmsController@updateaboutus');
        Route::post('/cms/save-about-meta', 'CmsController@save_about_meta');

        Route::get('/cms/leaders', 'CmsController@leaders');
        Route::get('/cms/create-leader', 'CmsController@createleader');
        Route::post('/cms/save-leader', 'CmsController@saveleader');
        Route::get('/cms/edit-leader/{id}', 'CmsController@editleader');
        Route::post('/cms/update-leader/{id}', 'CmsController@updateleader');
        Route::get('/cms/delete-leader/{id}', 'CmsController@deleteleader');

        Route::get('/message', 'MessageController@index');
        Route::get('/message/create', 'MessageController@create');
        Route::get('/message/edit/{id}', 'MessageController@edit');
        Route::post('/message/save', 'MessageController@save');
        Route::post('/message/update/{id}', 'MessageController@update');
        Route::post('/message/delete/{id}', 'MessageController@delete');
        /* CMS Page and alert message Route End */

        /* Product Categories Route Start */
        Route::get('/product-categories', 'ProductController@categorylisting');
        Route::post('/product-categories/category-sort', 'ProductController@categorySort');

        Route::get('productcategory/add', 'ProductController@addcategory');
        Route::post('productcategory/add', 'ProductController@savecategory');
        Route::get('productcategory/edit/{id}', 'ProductController@editcategory');
        Route::post('productcategory/edit/{id}', 'ProductController@updatecategory');
        Route::get('productcategory/delete/{id}', 'ProductController@deletecategory');
        Route::get('/products', 'ProductController@productlisting');
        Route::get('product/add', 'ProductController@addproduct');
        Route::post('product/add', 'ProductController@saveproduct');

        // Route::post('product/getrecommendedproduct', 'ProductController@getrecommendedproduct');
        Route::post('product/checkuniquesuk', 'ProductController@checkuniquesku');

        Route::get('product/edit/{id}', 'ProductController@editproduct');
        Route::get('product/delete/{id}', 'ProductController@deleteproduct');
        Route::post('productedit/edit/{id}', 'ProductController@editproductbyadmin');
        Route::post('/productexport', 'ProductController@productexport');
        /* Product Categories Route End */

        /* Video Route Start */
        Route::get('/videos', 'VideoController@videos');
        Route::get('/new-videos', 'VideoController@newVideo');
        Route::post('/update-new-video','VideoController@updateNewVideo');
        Route::get('/videossocials', 'VideoController@videossocials');
        Route::get('videossocials/edit/{id}', 'VideoController@editvideosocials');
        Route::post('videossocials/edit/{id}', 'VideoController@updatevideosocials');
        Route::get('videossocials/delete/{id}', 'VideoController@deletevideosocials');
        Route::get('videos/add/{id}', 'VideoController@addvideo');
        Route::post('videos/add', 'VideoController@savevideo');
        Route::get('videos/edit/{id}', 'VideoController@editvideo');
        Route::post('videos/edit/{id}', 'VideoController@updatevideo');
        Route::get('videos/delete/{id}', 'VideoController@deletevideo');
        Route::post('videos/sort', 'VideoController@sortvideo');
        Route::get('videos/{id}', 'VideoController@filtervideo');
        Route::post('videos/sortVideos', 'VideoController@sortVideos');
        Route::get('featured-videos', 'VideoController@featuredVideos');
        Route::get('featured-products', 'ProductController@featuredProducts');

        Route::post('featured-videos/sort', 'VideoController@sortFeaturedVideos');
        Route::post('featured-products/sort', 'ProductController@sortFeaturedProducts');

        Route::get('video-amenity', 'VideoController@videoamenity');
        Route::get('video-amenity/edit/{id}', 'VideoController@editvideoamenity');
        Route::post('video-amenity/edit/{id}', 'VideoController@updatevideoamenity');
        /* Video Route End */

        /* Donation Route Start */
        Route::get('/donation-goals', 'DonationController@goalListing');
        Route::get('donation-goals/addgoal', 'DonationController@addgoal');
        Route::post('donation-goals/addgoal', 'DonationController@savegoal');
        Route::get('donation-goals/editgoal/{id}', 'DonationController@editgoal');
        Route::post('donation-goals/editgoal/{id}', 'DonationController@updategoal');
        Route::get('donation-goals/deletegoal/{id}', 'DonationController@deletegoal');
         Route::post('/donationexport', 'DonationController@donationexport');
        /* Donation Route End */

        /*Close Monthly Donation Route Start*/
        Route::post('/donations/close-monthly-recurring', 'DonationController@closemonthlyrecurring');
        /*Close Monthly Donation Route End*/

        /*ORDER START */
        Route::get('/orders', 'ProductController@orderlisting');
        Route::get('orders/detail', 'ProductController@orderdetail');
        Route::post('orders/change_status', 'ProductController@changeorderstatus');
         Route::post('/orderexport', 'ProductController@orderexport');
        /*ORDER END*/
        Route::get('/setting', 'SettingController@index');
        Route::post('/setting', 'SettingController@update');
        /*Donation transactions START */
        Route::get('/donations', 'DonationController@donationlisting');
        Route::get('donation-detail', 'DonationController@donationdetail');
        /*Donation transactions END*/

        Route::get('sendmail', 'CartController@reSentMail');
//        Route::get('/prayer','PrayerController@index');

    });
});

//Home Page
Route::get('/', 'HomeController@index');
Route::get('/demo-home-page', 'HomeController@demo');
Route::get('/newsletterpost', 'HomeController@newsletter');
//Newsletter subscription
Route::post('/subscribe', 'HomeController@subscribe');
//Cart Page
Route::get('/cart', 'CartController@cart');


Route::get('about-us', 'HomeController@aboutus');
Route::get('social', 'HomeController@social');
Route::get('contact-us', 'HomeController@contactus');

Route::post('contact/save', 'HomeController@saveContactUs');

//Recurring Payment
Route::get('capture-recurring-amount', 'CronController@capturerecurringamount');

//Video Library
Route::get('/videos', 'HomeController@videolibrary');
Route::get('/load-videos', 'HomeController@loadvideos');
// Route::get('video/detail/{slug}', 'HomeController@videodetail');
Route::get('videos/{slug}', 'HomeController@videodetail');

Route::post('video/downloadVideo', 'HomeController@downloadVideo');

// Route::get('/all-store', 'HomeController@allmerch');

//Custom Store Shipstation
Route::get('shipstationxml', 'ShipstationController@shipstationrequest');
Route::post('shipstationxml', 'ShipstationController@shipstationresponse');

Route::get('prayer','HomeController@prayer');

Route::get('pagenotfound','ErrorHandlerController@pagenotfound');

Route::get('/test', 'CartController@test');

//Product Page

// Route::get('/store/{slug}', 'ProductController@detail');

//Product Page By Category

// Route::get('/store/{category}', 'ProductController@productByCategory');

//Checkout Page
Route::get('/checkout', 'CartController@checkout');
Route::post('/checkout', 'CartController@placeorder');

//Payment Page
Route::get('payment/make-payment/{id}', 'CartController@payment');
Route::post('payment/make-payment', 'CartController@makepayment');
Route::get('payment/make-payment', 'CartController@makepayment');

//Webhook
Route::post('stripe/chargehook', 'WebhookController@chargehook');

//Donation Page
Route::get('donate/', 'CartController@makedonation');
Route::post('donation/make-donation', 'CartController@donationpayment');
Route::get('donation/donation-receipt/{id}', 'CartController@donationreceipt');
Route::get('order-number', 'CartController@setDonationOrderNumber');


Route::get('donate/{id}', 'CartController@makedonation');
Route::post('donate', 'CartController@donationpayment');
//Cms pages
//Route::get('page/{slug}', 'HomeController@pages');

Route::get('/{slug}', 'HomeController@pages');


