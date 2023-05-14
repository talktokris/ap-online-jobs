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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('employer/login', 'HomeController@employerLogin')->name('employer.login');
Route::get('partner/login', 'HomeController@partnerLogin')->name('partner.login');
Route::get('retired/login', 'HomeController@retiredPerson')->name('retired.login');
Route::get('foreign-worker/login', 'HomeController@retiredPerson')->name('retired.login');

Route::get("/foreign-worker/login", function(){
    return view("auth.foregin_worker");
 })->name('foreign.worker');

 Route::get("foreign-worker/registration",  'Auth\ForeignRegisterController@createForeginWorker')->name('foreign.worker.registration');
 Route::post('foreign-worker/registration', 'Auth\ForeignRegisterController@foreginWorkerRegistration')->name('foreign.worker.registration.save');

Route::get('/admin/login', function(){
    return view('admin.login');
});
Route::get('/logout', function(){
    return view('admin.login');
});
Route::group(['middleware' => 'auth'], function(){
    Route::get('/changePassword', 'UserController@showPasswordChangeForm')->name('changePassword');
    Route::patch('/changePassword', 'UserController@changePassword')->name('updatePassword');
});
// Route::prefix('admin')->name('admin.')->middleware('role:agent|part-timer')->group(function () {
//     return '/agent';
// });

Route::prefix('admin')->name('admin.')->middleware('role:administrator|superadministrator|agent|employer|cadmin|sub-agent|part-timer')->group(function () {
    Route::get('/', function(){
        // dd('test');
        return view('admin.index');
    })->name('home');

    /*Notification*/
    Route::get('/notifications/all', 'Admin\NotificationController@showAllNotification')->name('showAllNotification');
    Route::get('/notifications/mark-all-as-read', 'Admin\NotificationController@markAllAsRead')->name('markAllAsRead');
    Route::get('/notifications/read/{id}', 'Admin\NotificationController@readSingleNotification')->name('readSingleNotification');
    Route::get('/notifications/delete/{id}', 'Admin\NotificationController@deleteSingleNotification')->name('deleteSingleNotification');
    

    /*Publish Unpublish*/
    Route::get('/publish/{table}/{id}', 'Admin\StatusController@publish')->name('publish');
    Route::get('/unpublish/{table}/{id}', 'Admin\StatusController@unpublish')->name('unpublish');


    
    /*Block Unblock --3/11/2020*/
    Route::get('/employer/block/{id}','Admin\StatusController@block')->name('employer.block');
    Route::get('/employer/unblock/{id}','Admin\StatusController@unblock')->name('employer.unblock');
    Route::get('/agent/block/{id}','Admin\StatusController@block')->name('agent.block');
    Route::get('/agent/unblock/{id}','Admin\StatusController@unblock')->name('agent.unblock');
    Route::get('/professional/block/{id}','Admin\StatusController@block')->name('professional.block');
    Route::get('/professional/unblock/{id}','Admin\StatusController@unblockjobseekers')->name('professional.unblock');
    Route::get('/retiredPersonnel/block/{id}','Admin\StatusController@block')->name('retiredPersonnel.block');
    Route::get('/retiredPersonnel/unblock/{id}','Admin\StatusController@unblockjobseekers')->name('retiredPersonnel.unblock');

    /*Employer*/
    Route::get('/employer/approve/{id}', 'Admin\EmployerController@approve')->name('employer.approve');
    Route::get('/employer/reject/{id}', 'Admin\EmployerController@reject')->name('employer.reject');
    Route::get('/agent/restore/{id}', 'Admin\Controller@restore')->name('agent.restore');
    Route::get('/getEmployersData', 'Admin\EmployerController@getEmployersData')->name('getEmployersData');
    Route::get('/getBlockedEmployersData', 'Admin\EmployerController@getBlockedEmployersData')->name('getBlockedEmployersData');
    Route::get('/employer-application', 'Admin\EmployerController@employerApplication')->name('employerApplication');
    Route::get('/getEmployersApplicationData', 'Admin\EmployerController@getEmployersApplicationData')->name('getEmployersApplicationData');
    Route::get('/employer/{user}/delete', 'Admin\EmployerController@delete')->name('employer.delete');
    Route::resource('/employer', 'Admin\EmployerController');

    Route::get('/employer-demands', 'Admin\EmployerController@employerDemands')->name('employerDemands');

    Route::Post('/employer-demands/country_id', 'Admin\EmployerController@agent_list_by_country')->name('employerDemandsbyid');



    Route::get('/employer-offers', 'Admin\EmployerController@employerOffers')->name('employerOffers');
    Route::get('/getEmployersDemandData', 'Admin\EmployerController@getEmployersDemandData')->name('getEmployersDemandData');
    Route::get('/getAgentData/{country_id}', 'Admin\EmployerController@getAgentData')->name('getAgentData');
    Route::post('/assignDemandAgent', 'Admin\EmployerController@assignDemandAgent')->name('assignDemandAgent');

    


    Route::post('/proposeGWToDemand', 'Admin\EmployerController@proposeGWToDemand')->name('proposeGWToDemand');
    Route::post('/finalizeGWToDemand', 'Admin\EmployerController@finalizeGWToDemand')->name('finalizeGWToDemand');
    ROute::post('/demandFileForAgent/{id}', 'Admin\EmployerController@demandFileForAgent')->name('demandFileForAgent');
    /*Agent*/
    Route::get('/agent/approve/{id}', 'Admin\AgentController@approve')->name('agent.approve');
    Route::get('/agent/reject/{id}', 'Admin\AgentController@reject')->name('agent.reject');
    Route::get('/agent/restore/{id}', 'Admin\AgentController@restore')->name('agent.restore');
    Route::get('/getAgentsData', 'Admin\AgentController@getAgentsData')->name('getAgentsData');
    Route::get('/geBlockedtAgentsData', 'Admin\AgentController@geBlockedtAgentsData')->name('geBlockedtAgentsData');
    Route::get('/agent-application', 'Admin\AgentController@agentApplication')->name('agentApplication');
    Route::get('/getAgentsApplicationData', 'Admin\AgentController@getAgentsApplicationData')->name('getAgentsApplicationData');
    Route::get('/rejected-agent-application', 'Admin\AgentController@rejectedAgentApplication')->name('rejectedAgentApplication');
    Route::get('/getRejectedAgentApplicationData', 'Admin\AgentController@getRejectedAgentApplicationData')->name('getRejectedAgentApplicationData');
    Route::get('/agent/{user}/delete', 'Admin\AgentController@delete')->name('agent.delete');
    Route::resource('/agent', 'Admin\AgentController');
    Route::get('/downloadFiles', 'Admin\AgentController@downloadFiles')->name('downloadFiles');

    /*Professional*/
    Route::get('/getProfessionalsData', 'Admin\ProfessionalController@getProfessionalsData')->name('getProfessionalsData');
    Route::get('/getBlockedProfessionalsData', 'Admin\ProfessionalController@getBlockedProfessionalsData')->name('getBlockedProfessionalsData');
    Route::get('/professional/{user}/delete', 'Admin\ProfessionalController@delete')->name('professional.delete');
    Route::resource('/professional', 'Admin\ProfessionalController');

    /*Retired*/
    Route::get('/getRetiredPersonnelsData', 'Admin\RetiredController@getRetiredPersonnelsData')->name('getRetiredPersonnelsData');
    Route::get('/getBlockedRetiredPersonnelsData', 'Admin\RetiredController@getBlockedRetiredPersonnelsData')->name('getBlockedRetiredPersonnelsData');
    Route::get('/retired/{user}/delete', 'Admin\RetiredController@delete')->name('retired.delete');
    Route::resource('/retired', 'Admin\RetiredController');

    // Part time services
    Route::get('/getPartTimeMaidsData', 'Admin\PMaidController@getPartTimeMaidsData')->name('getPartTimeMaidsData');
    Route::get('/getActivePartTimeMaidsData', 'Admin\PMaidController@getActivePartTimeMaidsData')->name('getActivePartTimeMaidsData');
    Route::get('/getBlockedPartTimeMaidsData', 'Admin\PMaidController@getBlockedPartTimeMaidsData')->name('getBlockedPartTimeMaidsData');

    /*Jobs*/
    Route::get('/getJobsData', 'Admin\JobController@getJobsData')->name('getJobsData');
    Route::get('/job/{job}/getJobseekerByPosition', 'Admin\JobController@getJobseekerByPosition')->name('job.getJobseekerByPosition');
    Route::get('/job/{job}/suggest-jobseekers', 'Admin\JobController@suggestJobseekers')->name('job.suggestJobseekers');
    Route::post('/job/{job}/suggest-jobseekers', 'Admin\JobController@sendSuggesion')->name('job.sendSuggesion');
    Route::get('/job-detail/{id}', 'Admin\JobController@viewJobDetail')->name('jobs.details');
    Route::resource('/job', 'Admin\JobController');

    /*Worker*/
    Route::get('/getWorkersData', 'Admin\WorkerController@getWorkersData')->name('getWorkersData');
    Route::get('/worker/{user}/delete', 'Admin\WorkerController@delete')->name('worker.delete');
    Route::resource('/worker', 'Admin\WorkerController');

    /*Maid*/
    Route::get('/getMaidsData', 'Admin\MaidController@getMaidsData')->name('getMaidsData');
    Route::get('/maid/{user}/delete', 'Admin\MaidController@delete')->name('maid.delete');
    Route::resource('/maid', 'Admin\MaidController');

    /*Proposed GW/DM */
    Route::get('/getProposedGwDm', 'Admin\SuperadminController@getProposedGwDm')->name('getProposedGwDm');
    Route::get('/proposedGwDm', 'Admin\SuperadminController@proposedGwDm')->name('proposedGwDm');
    Route::get('/proposedGwDm/release/{applicant}', 'Admin\SuperadminController@releaseProposedGwDm')->name('releaseProposedGwDm');

    /*Settings*/
    Route::resource('/country', 'Admin\CountryController');
    Route::get('/getCountryData', 'Admin\CountryController@getCountryData')->name('getCountryData');

    //  States added on 1/31/2020 
    Route::resource('/state', 'Admin\StateController');
    Route::get('/getStateData', 'Admin\StateController@getStateData')->name('getStateData');
    //  Cities added on 1/31/2020 
    Route::resource('/city', 'Admin\CityController');
    Route::get('/getCityData', 'Admin\CityController@getCityData')->name('getCityData');

    Route::resource('/religion', 'Admin\ReligionController');
    Route::get('/getReligionData', 'Admin\ReligionController@getReligionData')->name('getReligionData');

    Route::resource('/language', 'Admin\LanguageController');
    Route::get('/getLanguageData', 'Admin\LanguageController@getLanguageData')->name('getLanguageData');

    Route::resource('/gender', 'Admin\GenderController');
    Route::get('/getGenderData', 'Admin\GenderController@getGenderData')->name('getGenderData');

    Route::resource('/maritalStatus', 'Admin\MaritalStatusController');
    Route::get('/getMaritalStatusData', 'Admin\MaritalStatusController@getMaritalStatusData')->name('getMaritalStatusData');
    
    Route::resource('/skillLevel', 'Admin\SkillLevelController');
    Route::get('/getSkillLevelData', 'Admin\SkillLevelController@getSkillLevelData')->name('getSkillLevelData');

    Route::resource('/skill', 'Admin\SkillController');
    Route::get('/getSkillData', 'Admin\SkillController@getSkillData')->name('getSkillData');
    
    Route::resource('/educationLevel', 'Admin\EducationLevelController');
    Route::get('/getEducationLevelData', 'Admin\EducationLevelController@getEducationLevelData')->name('getEducationLevelData');
    
    Route::resource('/downloads', 'Admin\DownloadsController');
    Route::get('/getDownloadsData', 'Admin\DownloadsController@getDownloadsData')->name('getDownloadsData');

    Route::resource('/sector', 'Admin\SectorController');
    Route::get('/getSectorData', 'Admin\SectorController@getSectorData')->name('getSectorData');
    Route::get('/getSubsectors/{id}', 'Admin\SectorController@getSubsectors')->name('getSubsectors');

    Route::resource('/subSector', 'Admin\SubSectorController');

    Route::resource('/retiredPersonnelAcademic', 'Admin\RetiredPersonnelAcademicController');
    Route::get('/getretiredPersonnelAcademicData', 'Admin\RetiredPersonnelAcademicController@getretiredPersonnelAcademicData')->name('getretiredPersonnelAcademicData');

    Route::resource('/specialization', 'Admin\SpecializationController');
    Route::get('/getSpecializationData', 'Admin\SpecializationController@getSpecializationData')->name('getSpecializationData');

    Route::resource('/facilities', 'Admin\FacilitiesController');
    Route::get('/getFacilitiesData', 'Admin\FacilitiesController@getFacilitiesData')->name('getFacilitiesData');

    Route::resource('/gallery', 'Admin\GalleryController');
    Route::get('/getGalleryData', 'Admin\GalleryController@getGalleryData')->name('getGalleryData');

    Route::resource('/options', 'Admin\OptionController');
    Route::get('/getOptionsData', 'Admin\OptionController@getOptionsData')->name('getOptionsData');

    Route::get('/fast-registration', 'Admin\FastRegistrationController@index')->name('fast.registration');
    Route::get('/fast-registration-data', 'Admin\FastRegistrationController@getFastRegistrationData')->name('fast.registration.data');
    Route::get('/fast-registration/edit/{id}', 'Admin\FastRegistrationController@edit')->name('fast.registration.edit');
    Route::get('/fast-registration/detail/{id}', 'Admin\FastRegistrationController@show')->name('fast.registration.detail');
    Route::patch('fast-registration/{id}', 'Admin\FastRegistrationController@update')->name('fast_registration.update');
    Route::get('/fast-registration/{user}/delete', 'Admin\FastRegistrationController@destroy')->name('fast.registration.delete');
    
});

Route::post('/fast-registration', 'Admin\FastRegistrationController@store')->name('fast.registration');

Route::get('/', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile/{public}', 'ProfileController@public')->name('profile.public');
    Route::resource('profile', 'ProfileController')->except('destroy');
    Route::resource('experience', 'ExperienceController')->except('destroy');
});
Route::get('agent/createuser', 'AgentProfileController@createuser')->name('agent.createuser');
Route::post('agent/saveuser', 'AgentProfileController@saveuser')->name('agent.saveuser');
Route::get('agent/print/{id}/{data}', 'AgentProfileController@print')->name('agent.print');
Route::resource('agent', 'AgentProfileController')->except('destroy');

Route::get('/maids', 'HomeController@maids')->name('maids');
Route::any('/maids/search', 'HomeController@maidsearch')->name('maids.search');

Route::get('/workers', 'HomeController@workers')->name('workers');
Route::any('/workers/search', 'HomeController@workersearch')->name('workers.search');

Route::get('/CadidateStatusView', function(){
    return view('CadidateStatusView');
})->name('CadidateStatusView');

/*Employer*/
Route::prefix('employer')->group(function(){
    Route::get('/', 'EmployerProfileController@index')->name('employer.index');


    Route::get('/findStateName','DynamicDependentController@findStateName');
    Route::get('/findCityName','DynamicDependentController@findCityName');

    Route::get('/create','EmployerProfileController@create')->name('employer.create');
    Route::get('/profile', 'EmployerProfileController@show')->name('employer.show');
    Route::patch('/profile/{id}', 'EmployerProfileController@updateEmployeType')->name('employer.type.update');
    Route::get('/{id}/edit', 'EmployerProfileController@edit')->name('employer.edit');
    Route::patch('/{id}', 'EmployerProfileController@update')->name('employer.update');
    Route::get('/view/{public_id}', 'EmployerProfileController@public')->name('employer.public');
    Route::get('/getAllMaids', 'EmployerProfileController@getAllMaids')->name('getAllMaids');
    Route::post('/sendOffer', 'EmployerProfileController@sendOffer')->name('sendOffer');
    Route::get('/getProfessionalsData', 'EmployerProfileController@getProfessionalsData')->name('employer.getProfessionalsData');
    Route::post('/{job}/inviteProfessional', 'EmployerProfileController@inviteProfessional')->name('inviteProfessional');
    Route::get('/invites/{employer}', 'EmployerProfileController@invites')->name('employer.invites');
    Route::get('/professional/accepted/interview/{id}','EmployerProfileController@proffessionalAcceptedInterview')->name('professional.accepted.interview');
    Route::get('/professional/rejected/interview/{id}','EmployerProfileController@proffessionalRejectedInterview')->name('professional.rejected.interview');
    // Demand section
    

    Route::post('/saveDemand', 'EmployerProfileController@saveDemand')->name('saveDemand');

    Route::post('/addinterviewdatetime','EmployerProfileController@interviewdatetime')->name('addinterviewdatetime');

    Route::get('/getAllDemands', 'EmployerProfileController@getAllDemands')->name('getAllDemands');
    Route::get('/demand/{id}', 'EmployerProfileController@viewDemand')->name('demand');



    Route::get('/proposedGW/{damand_id}', 'EmployerProfileController@proposedGW')->name('proposedGW');
    Route::post('/confirmGWToDemand', 'EmployerProfileController@confirmGWToDemand')->name('confirmGWToDemand');

    Route::get('/getDownloadsFile/{type}', 'CommonController@getDownloadsFile')->name('getDownloadsFile');
});

/*Job*/
Route::get('/job/search', 'JobController@search')->name('job.search');
Route::get('/job/{job}/applyOnline', 'JobController@applyOnline')->name('applyOnline')->middleware('auth');
Route::get('/job/{job}/applicants', 'Admin\JobController@applicants')->name('applicants')->middleware('role:administrator|superadministrator');
Route::get('/job/{job}/getJobApplicants', 'Admin\JobController@getJobApplicants')->name('getJobApplicants')->middleware('role:administrator|superadministrator');
Route::get('/job/{job}/available-jobseekers', 'JobController@availableJobseekers')->name('availableJobseekers');
Route::resource('/job', 'JobController');

/*Professional*/

Route::group(['middleware' => 'auth'], function(){
    Route::get('/professional/profile', 'ProfessionalProfileController@profile')->name('professional.profile');
    Route::resource('/professional', 'ProfessionalProfileController')->except(['index','create','store','show']);
    Route::get('/qualification/{user}/edit', 'ProfessionalProfileController@editQualification')->name('qualification.edit');
    Route::patch('/qualification/{user}', 'ProfessionalProfileController@updateQualification')->name('qualification.update');
    Route::get('/professionalExperience/{user}/edit', 'ProfessionalProfileController@editProfessionalExperience')->name('professionalExperience.edit');
    Route::patch('/professionalExperience/{user}', 'ProfessionalProfileController@updateProfessionalExperience')->name('professionalExperience.update');
    //added by pawan
    Route::get('/part-time-employer', 'Admin\AdminPartTimeEmployerController@partTimeEmployer')->name('partTimeEmployer');
    Route::get('/parttimeemployer', 'Admin\AdminPartTimeEmployerController@getPartTimeEmployer')->name('getPartTimeEmployer');
    Route::get('/block-user/{user_id}', 'Admin\AdminPartTimeEmployerController@blockUser')->name('blockUser');
    Route::get('/unulock-user/{user_id}', 'Admin\AdminPartTimeEmployerController@unBlockUser')->name('unBlockUser');
    Route::get('/part-time-employer/show/{id}', 'Admin\AdminPartTimeEmployerController@show')->name('parttimeemployer.show');
    Route::get('/part-time-employer/{id}/edit', 'Admin\AdminPartTimeEmployerController@edit')->name('parttimeemployer.edit');
    Route::patch('/part-time-employer/update/{id}', 'Admin\AdminPartTimeEmployerController@update')->name('parttimeemployer.update');
    Route::get('/part-time-employer/reject/{id}','Admin\AdminPartTimeEmployerController@reject')->name('part-employer.reject');
    Route::get('/part-time-employer/approve/{id}','Admin\AdminPartTimeEmployerController@approve')->name('part-employer.approve');
    Route::get('part-time-employer/delete/{id}', 'Admin\AdminPartTimeEmployerController@destroy')->name('part-time-employer.delete');

    //active list
    Route::get('/active-part-time-employer', 'Admin\AdminPartTimeEmployerController@activePartTimeEmployer')->name('activePartTimeEmployer');
    Route::get('/inactive-part-time-employer', 'Admin\AdminPartTimeEmployerController@inactivePartTimeEmployer')->name('inactivePartTimeEmployer');

    Route::get('/active-part-time-employer-list', 'Admin\AdminPartTimeEmployerController@getActivePartTimeEmployer')->name('getActivePartTimeEmployer');
    Route::get('/inactive-part-time-employer-list', 'Admin\AdminPartTimeEmployerController@getInactivePartTimeEmployer')->name('getInactivePartTimeEmployer');

    Route::get('/send-mail/{id}', 'Admin\AdminPartTimeEmployerController@sendMailView')->name('sendmailview');
    Route::post('/send-mail/{id}', 'Admin\AdminPartTimeEmployerController@sendMail')->name('sendmail');

});
Route::get('/professional', 'ProfessionalProfileController@index')->name('professional.index');
Route::get('/professional/create', 'ProfessionalProfileController@create')->name('professional.create');
Route::post('/professional/store', 'ProfessionalProfileController@store')->name('professional.store');
Route::get('/professional/{id}', 'ProfessionalProfileController@show')->name('professional.show');

/*Retired Personnel*/
Route::get('/retiredPersonnel', 'RetiredPersonnelController@index')->name('retiredPersonnel.index');
Route::get('/retiredPersonnel/create', 'RetiredPersonnelController@create')->name('retiredPersonnel.create');
Route::post('/retiredPersonnel/store', 'RetiredPersonnelController@store')->name('retiredPersonnel.store');
Route::get('/retiredPersonnel/show/{id}', 'RetiredPersonnelController@show')->name('retiredPersonnel.show');

Route::get('/retiredPersonnel/profile', 'RetiredPersonnelController@profile')->name('retiredPersonnel.profile')->middleware('auth');
Route::get('/retiredPersonnel/{user}/edit', 'RetiredPersonnelController@edit')->name('retiredPersonnel.edit')->middleware('auth');
Route::post('/retiredPersonnel/{user}', 'RetiredPersonnelController@update')->name('retiredPersonnel.update')->middleware('auth');

Route::get('/retiredPersonnel/experience/add', 'RetiredPersonnelsWorkExperienceController@create')->name('retiredPersonnelExperience.create')->middleware('auth');
Route::post('/retiredPersonnel/experience/store', 'RetiredPersonnelsWorkExperienceController@store')->name('retiredPersonnelExperience.store')->middleware('auth');
Route::get('/retiredPersonnel/experience/{user}/edit', 'RetiredPersonnelsWorkExperienceController@edit')->name('retiredPersonnelExperience.edit')->middleware('auth');
Route::patch('/retiredPersonnel/experience/{user}', 'RetiredPersonnelsWorkExperienceController@update')->name('retiredPersonnelExperience.update')->middleware('auth');


Route::get('/retiredPersonnel/language/add', 'RetiredPersonnelsLanguageController@create')->name('retiredPersonnelsLanguage.create')->middleware('auth');
Route::post('/retiredPersonnel/language/store', 'RetiredPersonnelsLanguageController@store')->name('retiredPersonnelsLanguage.store')->middleware('auth');
Route::get('/retiredPersonnel/language/{user}/edit', 'RetiredPersonnelsLanguageController@edit')->name('retiredPersonnelsLanguage.edit')->middleware('auth');
Route::patch('/retiredPersonnel/language/{user}', 'RetiredPersonnelsLanguageController@update')->name('retiredPersonnelsLanguage.update')->middleware('auth');

Route::get('/gallery', 'Admin\GalleryController@gallery')->name('gallery');
Route::resource('/user','Admin\UserController');
Route::get('user/delete/{id}', 'Admin\UserController@destroy')->name('user.delete');
Route::get('/getUserData', 'Admin\UserController@getUserData')->name('getUserData');

Route::get('/json-regencies','EmployerProfileController@company_states');
Route::get('/json-states','EmployerProfileController@company_cities');

// Route::post('/AgentProfile/store', function () {
//         return 'Hello World';
//     })->name('AgentProfile.store');

Route::post('/ProfessionalPersonnel/store', 'ProfessionalProfileController@store')->name('ProfessionalPersonnel.store');
Route::post('/AgentProfile/store', 'AgentProfileController@store')->name('AgentProfile.store');   

// Route::get('/employer-application', 'Admin\EmployerController@employerApplication')->name('employerApplication');


Route::get('/blocked-employer', 'Admin\EmployerController@employerBlocked')->name('employerBlocked');
Route::get('/blocked-agent', 'Admin\AgentController@agentBlocked')->name('agentBlocked');
Route::get('/blocked-professional', 'Admin\ProfessionalController@professionalBlocked')->name('professionalBlocked');
Route::get('/blocked-retired', 'Admin\RetiredController@retiredBlocked')->name('retiredBlocked');

// Route::get('/admin/employer/create',function(){
//     return "yaaee";
// });

// 4/10/2020
Route::get('/admin/employer/create','Admin\EmployerController@create');
Route::post('/admin/employer/store','Admin\EmployerController@store')->name('employer.store');
// 5/7/2020
Route::get('/admin/professional/create','Admin\ProfessionalController@create');
Route::post('/admin/professional/store','Admin\ProfessionalController@store')->name('professional.store');

// 5/10/2020
Route::get('/admin/retired/create','Admin\RetiredController@create');
Route::post('/admin/retired/store','Admin\RetiredController@store')->name('retired.store');

Route::post('/maid/registration', 'PartTimeMaidController@store')->name('maid.registration');
Route::get('/maid/index', 'Admin\PMaidController@index')->name('maid.index');
Route::get('/pmaid/active', 'Admin\PMaidController@ActivePartTimeMaids')->name('maid.active');
Route::get('/pmaid/blocked', 'Admin\PMaidController@BlockedPartTimeMaids')->name('maid.blocked');
Route::get('/maid/block/{id}','Admin\StatusController@block')->name('maid.block');
Route::get('/maid/unblock/{id}','Admin\StatusController@unblock')->name('maid.unblock');
Route::group(['middleware' => 'auth'], function(){
    Route::resource('maid', 'Admin\PMaidController');
    Route::get('/maid/approve/{id}','Admin\PMaidController@approve')->name('maid.approve');
    Route::get('/maid/reject/{id}','Admin\PMaidController@reject')->name('maid.reject');
});
Route::post('/part-time-employer/registration', 'PartTimeEmployerController@store')->name('parttimeemployer.registration');
// Route::get('/test', 'PartTimeEmployerController@test');


// Route::get('/getPartTimeMaidsData', 'Admin\PMaidController@getPartTimeMaidsData')->name('getPartTimeMaidsData');
// Route::get('/pmaid/active',function(){
//     return 'nnn';
// })->name('maid.active');

Route::group(['prefix' => 'parttime-employer-profile-dashboard','middleware' => 'auth'], function(){
    Route::get('/{user_id}','Partimemployerprofile\PartTimeEmployerProfileController@index')->name('partimemployerprofile.index');
    Route::get('/edit/{user_id}','Partimemployerprofile\PartTimeEmployerProfileController@edit')->name('partimemployerprofile.edit');
    Route::patch('/update/{id}', 'Partimemployerprofile\PartTimeEmployerProfileController@update')->name('partimemployerprofile.update');
    

    Route::get('/changepassword/{user_id}', 'Partimemployerprofile\PartTimeEmployerProfileController@passwordChangeForm')->name('partimemployerprofile.changepassword');
    Route::patch('/changepassword', 'Partimemployerprofile\PartTimeEmployerProfileController@changePassword')->name('partimemployerprofile.updatePassword');
    Route::get('/upgrade-plan/{user_id}', 'Partimemployerprofile\PartTimeEmployerProfileController@upgradePlan')->name('upgradeplans');

    Route::get('/jobseeker-list/{user_id}', 'Partimemployerprofile\PartTimeEmployerProfileController@jobseekerList')->name('jobseekerlist');
    Route::get('/jobseeker-detail/{user_id}', 'Partimemployerprofile\PartTimeEmployerProfileController@jobseekerDetail')->name('jobseekerdetail');
});

//home page
Route::get('/recent-jobs', 'HomeController@recentJobs')->name('recent.job');
Route::get('/recent-jobs-details/{id}', 'HomeController@recentJobsDetails')->name('recent.job.details');
Route::get('/autocomplete/fetch', 'HomeController@autocomplete')->name('autocomplete.fetch');
Route::get("/about-us", function(){
    return view("aboutus");
 })->name('about.us');
 Route::get("/who-we-are", function(){
    return view("who_we_are");
 })->name('who.we.are');
 Route::get("/mission-vision", function(){
    return view("mission_vision");
 })->name('mission.vision');

//  Added for new look
 Route::get('/contact', function () {
    return view('contact');
});

Route::get('/fwwmc', function () {
    return view('fwwmc');
});
// Services
Route::get('/services',function(){
    return view('services');
});




