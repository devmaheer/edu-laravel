<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;
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

Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

Route::get('admin/dashboard', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);


// // Login Routes...
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login.get');
Route::post('admin/login', 'Auth\LoginController@login')->name('login.post');


// Logout Routes...
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

// // Registration Routes...
// Route::get('admin/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('admin/register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth'], function() {
    // Admin Routes
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {

        // Roles
        Route::get('/roles', ['as' => 'roles.index', 'uses' => 'RoleController@index']);
        Route::get('/roles/create', ['as' => 'roles.create', 'uses' => 'RoleController@create']);
        Route::post('/roles/store', ['as' => 'roles.store', 'uses' => 'RoleController@store']);
        Route::get('/roles/{id}/view', ['as' => 'roles.view', 'uses' => 'RoleController@show']);
        Route::get('/roles/{id}/edit', ['as' => 'roles.edit', 'uses' => 'RoleController@edit']);
        Route::post('/roles/{id}/update', ['as' => 'roles.update', 'uses' => 'RoleController@update']);
        Route::get('/roles/delete/{id}', ['as' => 'roles.delete', 'uses' => 'RoleController@delete']);

        // Permissions
        Route::get('/permissions', ['as' => 'permissions.index', 'uses' => 'PermissionController@index']);
        Route::get('/permissions/fetch', ['as' => 'permissions.fetch', 'uses' => 'PermissionController@fetch']);
        Route::post('/permissions/store', ['as' => 'permissions.store', 'uses' => 'PermissionController@store']);
        Route::get('/permissions/delete/{id}', ['as' => 'permissions.delete', 'uses' => 'PermissionController@delete']);

        Route::controller(TestController::class)->group(function () {
            Route::get('/test/index', 'index')->name('test.index');
            Route::get('/test/create', 'create')->name('test.create');
            Route::post('/test/store', 'store')->name('test.store');
            Route::get('/test/edit/{id}', 'edit')->name('test.edit');
            Route::post('/test/update/', 'update')->name('test.update');
            Route::get('/test/delete/{id}', 'delete')->name('test.delete');
            Route::get('test/{id}/paragraph/create/{type}', 'createParagraph')->name('test.paragraph.create');
            Route::post('test/paragraph/store', 'paragraphStore')->name('test.paragraph.store');

        });
        Route::controller(QuestionController::class)->group(function () {
            Route::get('test/question/index/{id}', 'index')->name('question.index');
            Route::post('test/question/store', 'store')->name('question.store');
            Route::get('test/question/edit/{id}', 'edit')->name('question.edit');
            Route::post('test/question/update/', 'update')->name('question.update');
            Route::get('test/question/delete/{id}', 'delete')->name('question.delete');
        });
    });
    



});
