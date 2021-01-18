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

App::make('files')->link(storage_path('app/public'), public_path('storage'));

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'ProductController@admin')->name('admin')->middleware('admin', 'auth');

Route::post('/add_product', 'ProductController@add_product')->name('addProduct');

Route::get('/view_product/{product_id}', 'ProductController@view_product')->name('viewProduct');

Route::post('/edit_product', 'ProductController@edit_product')->name('editProduct');

Route::post('/update_product', 'ProductController@update_product')->name('updateProduct');

Route::post('/delete_product', 'ProductController@delete_product')->name('deleteProduct');

Route::post('/add_category', 'CategoryController@add_category')->name('addCategory');

Route::post('/add_comment', 'CommentController@add_comment')->name('addComment');

Route::post('/add_comment_reply', 'CommentController@add_comment_reply')->name('addCommentReply');

Route::post('/delete_comment', 'CommentController@delete_comment')->name('deleteComment');

Route::get('/all_products', 'ProductController@all_products')->name('allProducts');

Route::get('/category/{category_id}', 'CategoryController@get_category_products')->name('getCategoryProducts');

Route::post('/add_to_cart', 'CartController@add_to_cart')->name('addToCart');

Route::get('/cart', 'CartController@cart')->name('cart');
