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

Auth::routes();


Route::get('/', 'HomeController@index');
Route::get('/reg_flow', 'Auth\RegisterController@reg_flow');
Route::get('/all_books', 'HomeController@index_all');
Route::get('author/{id}', 'AuthorController@getAuthor');
Route::get('authors', 'AuthorController@index');

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/view_pdf/{book}/{isLarge}', 'PdfController@pdf_viewer');
    Route::get('/pdf/{id}', 'PdfController@pdf_viewer');
    Route::get('/main', 'HomeController@index')->name('home');
    Route::post('get_b_p/{book}', 'PdfController@BinaryPdf');
    Route::post('get_b/{book}/{page}', 'PdfController@BinaryPdf_byPart');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('subir_pdf', 'PdfController@form_pdf')->name('subir_pdf');
    Route::post('post_pdf', 'PdfController@post_pdf');
    Route::get('libros', 'PdfController@index_admin');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login')->name('admin.login');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');
    Route::post('delete/{admin_id}', 'Auth\RegisterController@delete');
    Route::get('add_admin', 'Auth\RegisterController@showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register')->name('admin.register');
    Route::get('home', 'HomeAdminController@index')->name('admin.home');
});
