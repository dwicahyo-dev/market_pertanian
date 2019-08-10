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
Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);

/**
 * Route for Resource
 */

// Route for Commodity
Route::resource('commodity', 'CommodityController');

// Route for Quality
Route::resource('quality', 'QualityController');

// Route for User
Route::resource('user', 'UserController');

// Route for Stores
Route::resource('stores', 'StoreController');
Route::get('stores/{store}/storefront/{agriculture}', 'StoreController@front')->name('stores.front');
Route::match(['put', 'patch'], 'stores/{store}/update/thumbnail', 'StoreController@updateThumbnail')->name('store.update.thumbnail');
Route::match(['put', 'patch'], 'stores/{store}/update/cover', 'StoreController@updateCover')->name('store.update.cover');

// Route for Store Information
Route::get('stores/{store}/info', 'StoreController@storeInformation')->name('stores.information');

// Route for Store Review
Route::get('stores/{store}/review', 'StoreController@storeReview')->name('stores.review');

// Route for Filter Product on the Store
Route::get('stores/{store}/storefront/{agriculture}/filter', 'StoreController@filter')->name('stores.products.filter');

// Route for Addresses
Route::resource('addresses', 'AddressController');

// Route for Agriculture
Route::resource('agricultures', 'AgricultureController');

// Route for Search 
Route::get('search', 'AgricultureController@search')->name('search');

// Filter
Route::get('agricultures/{agriculture}/filter', 'AgricultureController@filter')->name('agricultures.filter');
// Search

// Route for Products
Route::resource('products', 'ProductController');
Route::get('products/{product}/discussions', 'ProductController@showDiscussionsProduct')->name('products.discussions');

// Route for Delete Product Discussion
Route::delete('products/{product}/delete/{product_discussion}', 'ProductDiscussionController@destroy')->name('products.discussions.destroy');

Route::match(['put', 'patch'], 'products/{product}/product_discussion/{product_discussion}', 'ProductDiscussionController@update')->name('products.discussions.update');
Route::get('products/{product}/discussions/{product_discussion}/edit', 'ProductDiscussionController@edit')->name('products.discussions.edit');


Route::get('products/{product}/reviews', 'ProductController@showReviewsProduct')->name('products.reviews');
Route::match(['put', 'patch'], 'products/{product}/set_stocked', 'ProductController@setStockedProduct')->name('products.set-stocked');
Route::match(['put', 'patch'], 'products/{product}/set_stockless', 'ProductController@setStocklessProduct')->name('products.set-stockless');

// Route for Product Discussions
Route::resource('product_discussions', 'ProductDiscussionController');

// Route for Updating User's Profile
Route::match(['put', 'patch'], '/user/password/update', 'UserController@updatePassword')->name('profile.password.update');

/**
 * Route for Settings
 */
Route::get('settings', 'SettingController@index')->name('setting.index');

// Route for Store Settings
Route::get('settings/stores/my_store', 'SettingController@store')->name('settings.store');
Route::get('settings/stores/pesanan', 'SettingController@pesanan')->name('settings.order');

/**
 * Route for Manage Products
 */
Route::get('manage-products/stocked', 'ProductController@listStockedProducts')->name('products.manage-product.stocked');
Route::get('manage-products/stockless', 'ProductController@listStocklessProducts')->name('products.manage-product.stockless');
Route::delete('manage-products/delete/{product}', 'ProductController@destroy')->name('products.manage-product.delete');

/**
 * Route For Stores
 */
Route::get('stores/products', 'StoreController@products')->name('stores.products');

/**
 * Route for Shopping Carts
 */
Route::get('carts/fetch', 'ShoppingCartController@fetch')->name('carts.fetch');
Route::resource('carts', 'ShoppingCartController');

// Route for Carts Checkout
Route::get('carts/{cart}/checkout', 'ShoppingCartController@checkOut')->name('carts.checkout');
Route::post('carts/{cart}/checkout/shipping', 'ShoppingCartController@shipping')->name('carts.shipping');


// Route::resource('ongkir', 'RajaOngkir\Costs');
Route::get('cost/service/{origin}/{destination}/{weight}/{courier}', 'RajaOngkir\Costs@init')->name('cost.show');

/**
 *  Route for Checkouts
 */
Route::get('payment/invoices', 'CheckoutController@paymentInvoices')->name('checkout.invoice');
Route::get('payment/transactions', 'CheckoutController@paymentTransactions')->name('checkout.transactions');
Route::post('checkout/storeSnap', 'CheckoutController@getSnapToken')->name('checkout.storeSnap');
Route::post('checkout/store', 'CheckoutController@store')->name('checkout.store');

Route::get('payment/invoices/{checkout}', 'CheckoutController@show')->name('checkout.show');

Route::get('payment/invoices/{checkout}/review', 'CheckoutController@review')->name('checkout.review');
Route::post('payment/invoices/{checkout}/store', 'CheckoutController@storeReview')->name('checkout.review.store');

Route::get('payment/transactions/{checkout}', 'CheckoutController@showTransaction')->name('checkout.transaction.show');

Route::post('payment/invoices/cancel/{order_id}', 'CheckoutController@cancelTransaction')->name('checkout.transaction.cancel');
Route::match(['put', 'patch'], 'payment/invoices/arrived/{checkout}', 'CheckoutController@setCheckoutArrived')->name('checkout.transaction.arrived');
Route::match(['put', 'patch'], 'payment/invoices/sented/{checkout}', 'CheckoutController@setCheckoutSented')->name('checkout.transaction.sented');
Route::match(['put', 'patch'], 'payment/invoices/approved/{checkout}', 'CheckoutController@setCheckoutApproved')->name('checkout.transaction.approved');
Route::match(['put', 'patch'], 'payment/invoices/rejected/{checkout}', 'CheckoutController@setCheckoutRejected')->name('checkout.transaction.rejected');
Route::get('payment/transaction/print/invoice/{checkout}', 'CheckoutController@printInvoice')->name('checkout.transaction.print.invoice');
/**
 * Cost
 */
 Route::get('shipping/{origin}/{destination}/{weight}/{courier}', 'RajaOngkir\Costs@init')->name('checkout.shipping');

/**
 *  Route fot Notifications Handler Midrans
 */
Route::post('notification/handler', 'OrderDetailController@notificationHandler')->name('notification.handler');


Route::get('chek', function(){
    return \App\Checkout::with(['checkout_processes'])->get()->first();
});