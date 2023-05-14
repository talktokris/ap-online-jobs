<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\EmployerController;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\FieldOptionController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\WorkerController;
use App\Http\Controllers\Api\DemandController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\PartnerController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/country',function(){
//     return Country::all();
// });

Route::get('/countries', [CountryController::class, 'index']);

Route::get('/states', [StateController::class, 'index']);

Route::get('/cities', [CityController::class, 'index']);

Route::get('/positions', [PositionController::class, 'index']);

Route::get('/field-options', [FieldOptionController::class, 'index']);

Route::get('/jobs', [JobController::class, 'index']);

Route::get('/jobs/{id}', [JobController::class, 'show']);        //completed

Route::get('/companies', [EmployerController::class, 'companies']);   //add job count also

Route::get('/companies/{id}', [EmployerController::class, 'companyDetail']);      //Completed

Route::get('/companies/{id}/jobs', [EmployerController::class, 'companyJobs']);      //to do  company le post gareko job list 

Route::post('/signup', [RegisterController::class, 'register']);

Route::post('/seeker-signup', [RegisterController::class, 'seekerSignUp']);

Route::post('/employer-signup', [RegisterController::class, 'employerSignUp']);

Route::post('/partner-signup', [RegisterController::class, 'partnerSignUp']);

Route::post('/verify-email', [UserController::class, 'verifyEmail']);

Route::post('/request-otp', [UserController::class, 'requestOtp']);

Route::post('/change-password', [UserController::class, 'changePassword']);



// Route::get('/seeker-vacancy-options',function(){
//     return "aaa";
// });

// Route::get('/demand/{id}',[EmployerController::class,'index']);

// Route::get('/demand',function(){
//     return "demand all";
// });

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::get('/country',[CountryController::class,'index']);

    // Route::get('/partner/foreign-worker/{id}',function(){
    //     return id;
    // });

    Route::get('/profile', [UserController::class, 'getProfile']);

    Route::get('/demand/{id}', [EmployerController::class, 'show']);
    Route::post('/logout', [UserController::class, 'logout']);


    // update seeker
    Route::post('/seeker/profile', [UserController::class, 'updateSeekerProfile']);


    // update partner
    Route::post('/partner/profile', [UserController::class, 'updatePartnerProfile']);

    // update Employer
    Route::post('/employer/profile', [UserController::class, 'updateEmployerProfile']);




    Route::group(["prefix" => "partner/"], function () {
        Route::get('worker-demands', [DemandController::class, 'getEmployersDemandDataForAgent']);
        Route::get('worker-demands/{id}', [DemandController::class, 'getEmployersDemandDetailsForAgent']);
        Route::get('worker-demands/{id}/workers', [DemandController::class, 'getEmployersDemandWorkersForAgent']);

        Route::get('foreign-workers', [WorkerController::class, 'getAgentForeignWorkers']);
        Route::get('foreign-workers/{id}', [WorkerController::class, 'ForeignWorkerDetail']);
        Route::post('foreign-workers', [WorkerController::class, 'ForeignWorkerDetail']);     //to do

        Route::post('add-foreign-worker', [WorkerController::class, 'addForeignWorker']);

        Route::patch('/{id}', [PartnerController::class, 'updateProfile']);
    });

    Route::group(["prefix" => "employer/"], function () {
        Route::get('demands', [DemandController::class, 'getEmployersDemandData']);       //completed
        Route::get('demands/{id}', [DemandController::class, 'getEmployersDemandDetails']);       //completed
        Route::get('demands/{id}/workers', [DemandController::class, 'getEmployersDemandWorkers']);       //completed
        Route::post('demands', [DemandController::class, 'getEmployersDemandData']);  //to do
        Route::get('jobs', [JobController::class, 'getEmployersJobs']);      // completed
        Route::post('save-job', [JobController::class, 'saveJob']);
        Route::post('save-demand', [DemandController::class, 'saveDemand']);
        Route::patch('/{id}', [EmployerController::class, 'updateProfile']);
    });



    Route::post('/file-upload', [UserController::class, 'fileUpload']);
});

Route::post("login", [UserController::class, 'index']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
