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

Route::get('/hello', 'HelloController@index');

Route::get('/', 'HelloController@greet');

Route::get('/user/{id}', 'HelloController@show');

Route::get('/run', 'UserPostsController@run');

Route::get('/posts/insert', 'UserPostsController@insert')->name('userposts.insert');

Route::post('/posts', 'UserPostsController@store')->name('userposts.store');

Route::get('/posts', 'UserPostsController@list')->name('userposts.list');

Route::delete('/posts/{id}', 'UserPostsController@delete')->name('userposts.delete');

Route::put('/posts/{id}', 'UserPostsController@update')->name('userposts.update');

Route::get('/posts/{id}/edit', 'UserPostsController@edit')->name('userposts.edit');

Route::get('/posts/export/excel', 'UserPostsController@excelExport')->name('userposts.export.excel');

Route::get('/posts/export/pdf', 'UserPostsController@pdfExport')->name('userposts.export.pdf');

Route::get('/posts/datatable', 'UserPostsController@datatable')->name('userposts.datatable');

Route::get('/debug-datatable', function () {
    return app()->make('App\Http\Controllers\UserPostsController')->datatable(request());
});
