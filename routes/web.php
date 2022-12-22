<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});


Route::group(
    [
        'prefix' => (new Mcamara\LaravelLocalization\LaravelLocalization)->setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    //------------------------dashboard--------------------
    Route::group(['namespace' => 'Grades'], function () {
        Route::resource('Grades', 'GradeController');
    });
    //------------------------Classrooms----------------------------
    Route::group(['namespace' => 'Classrooms'], function () {
        Route::resource('Classrooms', 'ClassroomController');
        Route::post('delete_all', [App\Http\Controllers\Classrooms\ClassroomController::class, 'delete_all'])->name('delete_all');
        Route::post('/Filter_Classes', [App\Http\Controllers\Classrooms\ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');

    });

    //-----------------------Sections-------------------------------
    Route::group(['namespace' => 'Sections'], function () {
        Route::resource('Sections', 'SectionController');
        Route::get('/class/{id}', [App\Http\Controllers\Sections\SectionController::class, 'getClasses']);
    });
    //------------------------Parents----------------------------dq
    Route::view('add_parent', 'livewire.show_Form')->name('add_parent');
//    Route::get('show_table','livewire.Parent_Table')->name('show_table');
/////////////---------teachers-------------////////////////
    Route::group(['namespace' => 'Teachers'], function () {
        Route::resource('Teachers', 'TeacherController');
    });
    //////////////////students//////////////////////////
    Route::group(['namespace' => 'Students'], function () {
        Route::resource('Students', 'StudentController');
        Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
        Route::resource('Graduated', 'GraduatedController');
        Route::resource('receipt_students', 'ReceiptStudentsController');
        Route::resource('ProcessingFee', 'ProcessingFeeController');
        Route::resource('Payment_students', 'PaymentController');
        Route::resource('Fees', 'FeesController');
        Route::resource('Fees_Invoices', 'FeesInvoicesController');
        Route::get('/Get_sections/{id}', 'StudentController@Get_sections');
        Route::post('/Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
        Route::get('/Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
        Route::post('/Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');

    });
///-----------------PromotionController****************************
    Route::group(['namespace' => 'Students'], function () {
        Route::resource('Promomotion', 'promotionController');


    });

});


Route::get('/home', 'HomeController@index')->name('home');





