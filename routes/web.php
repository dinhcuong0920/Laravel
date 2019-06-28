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
//Back-end

Route::get('login','backend\LoginController@Login')->middleware('CheckLogout');
Route::post('login','backend\LoginController@PostLogin');
Route::get('sentmail','backend\LoginController@SentMail');
Route::group(['prefix' => 'admin','middleware'=>'CheckLogin'], function () {
    Route::get('logout','backend\LoginController@Logout');
    Route::get('','backend\HomeController@Home');
    Route::group(['prefix' => 'category'], function () {
        Route::get('','backend\CategoryController@Category');
        Route::get('del/{id}','backend\CategoryController@DelCategory');
        Route::get('edit/{id}','backend\CategoryController@EditCategory');
        Route::post('','backend\CategoryController@PostCategory');\
        Route::post('edit/{id}','backend\CategoryController@PostEditCategory');
    });
    Route::group(['prefix' => 'user','middleware'=>'CheckUser'], function () {
        Route::get('','backend\UserController@Getlistuser');
    });
    Route::group(['prefix' => 'comment'], function () {
        Route::get('','backend\CommentController@Comment');
        Route::get('edit','backend\CommentController@EditComment');
    });
    Route::group(['prefix' => 'order'], function () {
        Route::get('','backend\OrderController@Order');
        Route::get('processed','backend\OrderController@OrderProcessed');
        Route::get('orderprocessed/{id}','backend\OrderController@CheckOrder');
        Route::get('detail/{id}','backend\OrderController@DetailOrder');
    });
    Route::group(['prefix' => 'product'], function () {
        Route::get('','backend\ProductController@Product');
        Route::get('edit/{id}','backend\ProductController@EditProduct');
        Route::post('edit/{id}','backend\ProductController@PostEditProduct');
        Route::get('del/{id}','backend\ProductController@DelProduct');
        Route::get('add','backend\ProductController@Addproduct');
        Route::post('add','backend\ProductController@PostAddproduct');

        Route::get('attr','backend\AttrController@Attr');
        Route::post('add-attr','backend\AttrController@AddAttr');
        Route::get('edit-attr/{id}','backend\AttrController@EditAttr');
        Route::post('edit-attr/{id}','backend\AttrController@PostEditAttr');
        Route::get('del-attr/{id}','backend\AttrController@PostDelAttr');

        Route::get('edit-value/{id}','backend\AttrController@EditValue');
        Route::post('edit-value/{id}','backend\AttrController@PostEditValue');
        Route::post('add-value','backend\AttrController@AddValue');

        Route::get('edit-variant/{id}','backend\VariantController@EditVariant');
        Route::post('edit-variant/{id}','backend\VariantController@PostEditVariant');
        Route::get('add-variant/{id}','backend\VariantController@AddVariant');
        Route::post('add-variant/{id}','backend\VariantController@PostAddVariant');
        Route::get('del-variant/{id}','backend\VariantController@DelVariant');
        
    });
});
//Front_end
Route::get('','Frontend\HomeController@Home');
Route::get('about','Frontend\AboutController@About');
Route::get('cart','Frontend\CartController@Cart');
Route::get('delcart/{id}','Frontend\CartController@DelCart');
Route::get('updatecart/{rowId}/{qty}','Frontend\CartController@UpdateCart');
Route::get('contact','Frontend\ContactController@Contact');

Route::group(['prefix' => 'products'], function () {
    Route::get('detail/{slug}','Frontend\ProductsController@Detailproduct');
    Route::get('','Frontend\ProductsController@Products');
    Route::get('cart','Frontend\ProductsController@AddCart');
    


});
Route::group(['prefix' => 'checkout'], function () {
    Route::get('','Frontend\CheckoutController@Checkout');
    Route::post('','Frontend\CheckoutController@PostCheckout');
    Route::get('complete/{id}','Frontend\CheckoutController@Complete');
});

Route::get('del-session', function () {
    
    session()->flush();
});
