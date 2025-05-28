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

// routes/web.php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\UserPostsController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('userposts', 'UserPostsController')->except(['loginRedirect', 'login']);

    Route::get('/posts/insert', 'UserPostsController@insert')->name('userposts.insert');

    Route::post('/posts', 'UserPostsController@store')->name('userposts.store');

    Route::get('/posts', 'UserPostsController@list')->name('userposts.list');

    Route::delete('/posts/{id}', 'UserPostsController@delete')->name('userposts.delete');

    Route::put('/posts/{id}', 'UserPostsController@update')->name('userposts.update');

    Route::get('/posts/{id}/edit', 'UserPostsController@edit')->name('userposts.edit');

    Route::get('/posts/export/excel', 'UserPostsController@excelExport')->name('userposts.export.excel');

    Route::get('/posts/export/pdf', 'UserPostsController@pdfExport')->name('userposts.export.pdf');

    Route::get('/posts/datatable', 'UserPostsController@datatable')->name('userposts.datatable');

    Route::get('/about', 'AboutController@about')->name('about');

    Route::get('/dashboard', 'UserPostsController@dashboard')->name('dashboard');

    Route::get('/profile', 'ProfileController@show')->name('profile.show');

    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');

    Route::put('/profile', 'ProfileController@update')->name('profile.update');

    Route::get('/users', 'UsersController@list')->name('users.list');

    Route::get('/users/datatable', 'UsersController@getUsersData')->name('users.get.data');

    Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');

    Route::put('/users/{id}', 'UsersController@update')->name('users.update');

    Route::get('/users/insert', 'UsersController@insert')->name('users.insert');

    Route::post('/users/store', 'UsersController@store')->name('users.store');

    Route::delete('/users/delete', 'UsersController@delete')->name('users.delete');
});

Route::redirect('/', '/login');

Route::get('/login', 'UserPostsController@showLogin')->name('login');

Route::post('/login', 'UserPostsController@login')->name('login.post');

Route::post('/logout', 'UserPostsController@logout')->name('userposts.logout');
