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

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

// Login Routes...
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login.get');
Route::post('/login', 'Auth\LoginController@login')->name('login.post');


// Logout Routes...
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth'], function() {
    // Admin Routes
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('/partners', ['as' => 'partners.index', 'uses' => 'PartnerController@index']);
        Route::get('/partners/create', ['as' => 'partners.create', 'uses' => 'PartnerController@create']);
        Route::post('/partners/store', ['as' => 'partners.store', 'uses' => 'PartnerController@store']);
        Route::get('/partners/delete/{id}', ['as' => 'partners.delete', 'uses' => 'PartnerController@delete']);

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
    });
    
    // Partner Routes
    Route::group(['prefix' => 'partner', 'as' => 'partner.'], function() {
        Route::get('/businessunits', ['as' => 'businessunits.index', 'uses' => 'BusinessUnitController@index']);
        Route::get('/businessunits/create', ['as' => 'businessunits.create', 'uses' => 'BusinessUnitController@create']);
        Route::post('/businessunits/store', ['as' => 'businessunits.store', 'uses' => 'BusinessUnitController@store']);
        Route::get('/businessunits/delete/{id}', ['as' => 'businessunits.delete', 'uses' => 'BusinessUnitController@destroy']);
    });

    Route::get('/treatment/categories/{id}/services', ['as' => 'category.service', 'uses' => 'RelationalDataController@fetchTreatmentCategoryServices']);
    Route::get('/treatment/services/{id}/procedures', ['as' => 'service.procedure', 'uses' => 'RelationalDataController@fetchTreatmentServiceProcedures']);
    
    // Business Unit Routes
    Route::group(['prefix' => 'businessunit', 'as' => 'bu.'], function() {
        Route::group(['prefix' => 'branch', 'as' => 'branch'], function() {
            Route::post('/data', ['as' => 'data', 'uses' => 'RelationalDataController@fetchBranchData']);
        });

        // Branches
        Route::get('/branches', ['as' => 'branches.index', 'uses' => 'BranchController@index']);
        Route::get('/branches/create', ['as' => 'branches.create', 'uses' => 'BranchController@create']);
        Route::post('/branches/store', ['as' => 'branches.store', 'uses' => 'BranchController@store']);
        Route::get('/branches/delete/{id}', ['as' => 'branches.delete', 'uses' => 'BranchController@delete']);
    
        // Patients
        Route::get('/patients', ['as' => 'patients.index', 'uses' => 'PatientController@index']);
        Route::get('/patients/{id}/profile', ['as' => 'patients/profile', 'uses' => 'PatientController@profile']);
        Route::get('/patients/fetch', ['as' => 'patients.fetch', 'uses' => 'PatientController@fetch']);
        Route::get('/patients/create', ['as' => 'patients.create', 'uses' => 'PatientController@create']);
        Route::post('/patients/store', ['as' => 'patients.store', 'uses' => 'PatientController@store']);
        Route::get('/patients/delete/{id}', ['as' => 'patients.delete', 'uses' => 'PatientController@delete']);

        // Appointment
        Route::get('/appointments', ['as' => 'appointments.index', 'uses' => 'AppointmentController@index']);
        Route::get('/appointments/fetch', ['as' => 'appointments.fetch', 'uses' => 'AppointmentController@fetch']);
        Route::get('/appointments/create', ['as' => 'appointments.create', 'uses' => 'AppointmentController@create']);
        Route::post('/appointments/store', ['as' => 'appointments.store', 'uses' => 'AppointmentController@store']);
        Route::get('/appointments/delete/{id}', ['as' => 'appointments.delete', 'uses' => 'AppointmentController@delete']);
        
        // Chairs
        Route::get('/chairs', ['as' => 'chairs.index', 'uses' => 'ChairController@index']);
        Route::get('/chairs/fetch', ['as' => 'chairs.fetch', 'uses' => 'ChairController@fetch']);
        Route::get('/chairs/create', ['as' => 'chairs.create', 'uses' => 'ChairController@create']);
        Route::post('/chairs/store', ['as' => 'chairs.store', 'uses' => 'ChairController@store']);
        Route::get('/chairs/delete/{id}', ['as' => 'chairs.delete', 'uses' => 'ChairController@delete']);

        // Specializations
        Route::get('/clinical/specialization', ['as' => 'clinical.specialization.index', 'uses' => 'ClinicalSpecializationController@index']);
        Route::get('/clinical/specialization/fetch', ['as' => 'clinical.specialization.fetch', 'uses' => 'ClinicalSpecializationController@fetch']);
        Route::get('/clinical/specialization/create', ['as' => 'clinical.specialization.create', 'uses' => 'ClinicalSpecializationController@create']);
        Route::post('/clinical/specialization/store', ['as' => 'clinical.specialization.store', 'uses' => 'ClinicalSpecializationController@store']);
        Route::get('/clinical/specialization/delete/{id}', ['as' => 'clinical.specialization.delete', 'uses' => 'ClinicalSpecializationController@delete']);

        // Treatment Categories
        Route::get('/treatment/categories', ['as' => 'treatment.category.index', 'uses' => 'TreatmentCategoryController@index']);
        Route::get('/treatment/categories/fetch', ['as' => 'treatment.category.fetch', 'uses' => 'TreatmentCategoryController@fetch']);
        Route::get('/treatment/categories/create', ['as' => 'treatment.category.create', 'uses' => 'TreatmentCategoryController@create']);
        Route::post('/treatment/categories/store', ['as' => 'treatment.category.store', 'uses' => 'TreatmentCategoryController@store']);
        Route::get('/treatment/categories/delete/{id}', ['as' => 'treatment.category.delete', 'uses' => 'TreatmentCategoryController@delete']);

        // Treatment Services
        Route::get('/treatment/services', ['as' => 'treatment.service.index', 'uses' => 'TreatmentServiceController@index']);
        Route::get('/treatment/services/fetch', ['as' => 'treatment.service.fetch', 'uses' => 'TreatmentServiceController@fetch']);
        Route::get('/treatment/services/create', ['as' => 'treatment.service.create', 'uses' => 'TreatmentServiceController@create']);
        Route::post('/treatment/services/store', ['as' => 'treatment.service.store', 'uses' => 'TreatmentServiceController@store']);
        Route::get('/treatment/services/delete/{id}', ['as' => 'treatment.service.delete', 'uses' => 'TreatmentServiceController@delete']);

        // Treatment Procedures
        Route::get('/treatment/services/procedures', ['as' => 'treatment.service.procedure.index', 'uses' => 'TreatmentProcedureController@index']);
        Route::get('/treatment/services/procedures/fetch', ['as' => 'treatment.service.procedure.fetch', 'uses' => 'TreatmentProcedureController@fetch']);
        Route::get('/treatment/services/procedures/create', ['as' => 'treatment.service.procedure.create', 'uses' => 'TreatmentProcedureController@create']);
        Route::post('/treatment/services/procedures/store', ['as' => 'treatment.service.procedure.store', 'uses' => 'TreatmentProcedureController@store']);
        Route::get('/treatment/services/procedures/delete/{id}', ['as' => 'treatment.service.procedure.delete', 'uses' => 'TreatmentProcedureController@delete']);

        // Employments Procedures
        Route::get('/employments', ['as' => 'employment.index', 'uses' => 'EmploymentController@index']);
        Route::get('/employments/fetch', ['as' => 'employment.fetch', 'uses' => 'EmploymentController@fetch']);
        Route::get('/employments/create', ['as' => 'employment.create', 'uses' => 'EmploymentController@create']);
        Route::post('/employments/store', ['as' => 'employment.store', 'uses' => 'EmploymentController@store']);
        Route::get('/employments/delete/{id}', ['as' => 'employment.delete', 'uses' => 'EmploymentController@delete']);

        // Case
        Route::get('/cases', ['as' => 'case.index', 'uses' => 'CaseRecordController@index']);
        Route::get('/cases/fetch', ['as' => 'case.fetch', 'uses' => 'CaseRecordController@fetch']);
        Route::get('/cases/{id}/view', ['as' => 'case.show', 'uses' => 'CaseRecordController@show']);
        Route::get('/cases/create', ['as' => 'case.create', 'uses' => 'CaseRecordController@create']);
        Route::post('/cases/store', ['as' => 'case.store', 'uses' => 'CaseRecordController@store']);
        Route::get('/cases/{id}/edit', ['as' => 'case.edit', 'uses' => 'CaseRecordController@edit']);
        Route::post('/cases/{case}/update', ['as' => 'case.update', 'uses' => 'CaseRecordController@update']);
        Route::get('/cases/delete/{id}', ['as' => 'case.delete', 'uses' => 'CaseRecordController@delete']);

        // Complaint Type
        Route::get('/complaint/types', ['as' => 'complaint.type.index', 'uses' => 'ComplaintTypeController@index']);
        Route::get('/complaint/types/fetch', ['as' => 'complaint.type.fetch', 'uses' => 'ComplaintTypeController@fetch']);
        Route::get('/complaint/types/create', ['as' => 'complaint.type.create', 'uses' => 'ComplaintTypeController@create']);
        Route::post('/complaint/types/store', ['as' => 'complaint.type.store', 'uses' => 'ComplaintTypeController@store']);
        Route::get('/complaint/types/delete/{id}', ['as' => 'complaint.type.delete', 'uses' => 'ComplaintTypeController@delete']);
    });
});
