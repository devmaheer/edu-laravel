<?php

use App\Http\Controllers\AcademicTestController;
use App\Http\Controllers\FinishedTestController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GeneralTrainingTestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListeningTestController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionGroupController;
use App\Http\Controllers\ReadingTestController;
use App\Http\Controllers\RegisterationRequestController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLoginController;
use App\Models\FinishedTest;
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
Route::get('/ielts/prepration-courses', [FrontendController::class, 'preprationCourses'])->name('frontend.ielts.prepration-courses');
Route::get('/ielts/practice-marterial', [FrontendController::class, 'practiceMarterial'])->name('frontend.ielts.practice-marterial');
Route::get('/ielts/practice-ielts-online', [FrontendController::class, 'onlineTest'])->name('frontend.ielts.practice-ielts-online');
///

Route::get('/general-training/test', [GeneralTrainingTestController::class, 'getGeneralTrainingTests'])->name('general.training.test');
Route::get('/Academic/test', [AcademicTestController::class, 'getAcademicTest'])->name('academic.training.test');
////LISTENING
Route::get('/listening/test/{id}', [ListeningTestController::class, 'index'])->name('listening.test');
Route::post('/listening/test/finish', [ListeningTestController::class, 'finish'])->name('listening.test.finish');
///READING TEST
Route::get('/reading/test/{id}', [ReadingTestController::class, 'index'])->name('reading.test');
Route::post('/reading/test/finish', [ReadingTestController::class, 'finish'])->name('reading.test.finish');
Route::get('/test/score/{id}', [FinishedTestController::class, 'score'])->name('test.score');
Route::get('/test/correct/answer/{id}', [FinishedTestController::class, 'correctAnswers'])->name('test.correct.answer');
Route::get('/test/correct/listening/answer/{id}', [FinishedTestController::class, 'correctListeningAnswers'])->name('we');

///////////////////////////////////////////

Route::get('/show/listening/test/{id}', [ListeningTestController::class, 'show'])->name('show.listening.test');
Route::get('/show/reading/test/{id}', [ReadingTestController::class, 'show'])->name('show.reading.test');
Route::controller(RegisterationRequestController::class)->group(function () {
    Route::get('registeration-request/create', 'create')->name('registeration-request-front-end.create');
    Route::get('registeration-request/index', 'index')->name('registeration-request.index');
    Route::post('registeration-request/store', 'store')->name('registeration-request.store');
    Route::get('registeration-request/edit/{id}', 'edit')->name('registeration-request.edit');
    Route::post('registeration-request/update', 'update')->name('registeration-request.update');
    Route::get('registeration-request/delete/{id}', 'delete')->name('registeration-request.delete');
});
Route::get('admin/dashboard', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);


Route::get('user/dashboard', [HomeController::class, 'userDashboard'])->name('user.dashboard');



// // Login Routes...
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login.get');
Route::post('admin/login', 'Auth\LoginController@login')->name('login.post');


// Logout Routes...
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

// // Registration Routes...
// Route::get('admin/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('admin/register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth'], function () {
    // Admin Routes
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

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
            Route::get('test/{id}/audio/create/{type}', 'createAudio')->name('test.audio.create');
            Route::post('test/audio/store', 'audioStore')->name('test.audio.store');
        });
        Route::controller(QuestionController::class)->group(function () {
            Route::get('test/question/index/{id}', 'index')->name('question.index');
            Route::post('test/question/store', 'store')->name('question.store');
            Route::get('test/question/edit/{id}', 'edit')->name('question.edit');
            Route::get('test/question/fill-in-blanks/edit/{id}', 'editFillInBlanks')->name('question.fillinblanks.edit');
            Route::post('test/question/update/', 'update')->name('question.update');
            Route::get('test/question/delete/{id}', 'delete')->name('question.delete');
            Route::get('test/five/options-edit/{id}', 'editFiveOptions')->name('five-options.edit');
        });
        Route::controller(QuestionGroupController::class)->group(function () {
            Route::get('test/question-group/index/{id}', 'index')->name('question.group.index');
            Route::get('test/question-group/create/{id}', 'create')->name('question.group.create');
            Route::post('test/question-group/store', 'store')->name('question.group.store');
            Route::get('test/question-group/delete/{id}', 'delete')->name('question.group.delete');
        });
        Route::controller(UserController::class)->group(function () {
            Route::get('user/index', 'index')->name('user.index');
            Route::get('user/create', 'create')->name('user.create');
            Route::post('user/store', 'store')->name('user.store');
            Route::get('user/edit/{id}', 'edit')->name('user.edit');
            Route::post('user/update', 'update')->name('user.update');
            Route::get('user/delete/{id}', 'delete')->name('user.delete');
        });
    });
});
Route::post('/startTimer', [FinishedTestController::class, 'startTimer'])->name('startTimer');
Route::get('/getCountdownValue', [FinishedTestController::class, 'getCountdownValue'])->name('getCountdownValue');
Route::get('listening/getCountdownValue', [FinishedTestController::class, 'getlisteningCountdownValue'])->name('getlisteningCountdownValue');


/////LOGIN FOR TEST

// Registration Routes...
Route::get('user/login', [UserLoginController::class, 'showLoginForm'])->name('show.loginForm');
Route::post('admin/register', 'Auth\RegisterController@register');

///paid test


Route::controller(TestController::class)->group(function () {
    Route::get('user/academic/tests', 'academicTest')->name('academic.tests');
    Route::get('user/general-training/tests', 'generalTest')->name('general-training.tests');
});
