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


/*
 * ----------------------------------------------------------------------------
 * Application Routes
 * ----------------------------------------------------------------------------
 * this route group aplies the " web" middleware group to every route
 * it containes. the "web" middleware group is defined in your http
 * kerenel and include session state, CSRF protection, and more.*
 */
Route::group(['middleware' => ['web']], function () {

    Route::get('/login', function () {
        return view('welcome');
    })->name('login');

    Route::get('/', 'postController@getBlogs')->name('blogs');

    Route::get('search/{s?}','postController@getSearch')->where('s','[\w\d]+');

    Route::get('userimage/{filename}', 'UserController@getUserImage')->name('account.image');

    Route::post('/getlike/{post_id}', 'postController@getLike')->name('get.like');

    Route::post('readmore/getComments', 'postController@getComments')->name('readmore.get.comments');

    Route::post('navigate/getComments', 'postController@getComments')->name('navigate.get.comments');

    Route::post('getComments', 'postController@getComments')->name('get.comments');

    Route::post('/getreply', 'PostController@getReply')->name('post.get.reply');

    Route::get('/readmore/{post_id}', 'PostController@readMore')->name('blog.readmore');

    Route::get('/navigate/{type}', 'PostController@getNavigation')->name('navigate');

});

Route::group(['prefix' => 'user'], function () {
    //sing in and up

    Route::post('/signUp', 'UserController@postSingUp')->name('signUp');

    Route::post('/signIn', 'UserController@postSignIn')->name('signIn');

});

Route::group(['middleware' => 'auth'], function () {
    //dashboard

    Route::get('/dashboard', 'postController@getdashboard')->name('dashboard');

    // create post

    Route::post('/createpost', 'postController@postCreatePost')->name('post.create');

    //delete post

    Route::get('/delete-post/{post_id}', 'PostController@getDeletePost')->name('post.delete');

    //edit post

    Route::post('/edit', 'PostController@postEditPost')->name('edit');


    /* =============================================================================  */

    //like
    Route::post('/like', 'PostController@postLikePost')->name('like');

    //comment
    Route::post('/comment', 'PostController@postComment')->name('comment');

    Route::post('/editcomment', 'PostController@postEditComment')->name('edit.comment');

    Route::post('/deletecomment', 'PostController@postDeleteComment')->name('delete.comment');

    //reply

    Route::post('/reply', 'PostController@postReply')->name('post.reply');

    //account

    Route::get('/account', 'UserController@getAccount')->name('account');

    Route::post('/updateAccount', 'UserController@postSaveAccount')->name('account.save');

    //logout

    Route::get('/logout', 'UserController@getLogout')->name('logout');
});