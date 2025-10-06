<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\Auth\CandidateLoginController;
use App\Http\Controllers\Candidate\CandidateController;
use App\Http\Controllers\Frontend\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Frontend\Auth\CompanyLoginController;
use App\Http\Controllers\Admin\RankController;
use App\Http\Controllers\Admin\ShipTypeController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\MobileCountryCodeController;
use App\Http\Controllers\Admin\DceEndorsementController;
use App\Http\Controllers\Admin\CourseCertificateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\Candidate\CandidateRegistrationController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Admin\company\CompanyRegisterController;
use App\Http\Controllers\Admin\Hotjobs\HotjobsController;
use App\Http\Controllers\Admin\Message\MessageController;
use App\Http\Controllers\Company\MessageController as CompanyMessageController;
use App\Http\Controllers\Admin\Candidate\CandidateController as AdminCandidateController;

// ----------------------------
// Static / Marketing pages
// ----------------------------
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/advertise', 'advertise')->name('advertise');
    Route::get('/maritime-institutes', 'maritimeInstitutes')->name('maritime.institutes');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/privacy', 'privacy')->name('privacy');
    Route::get('/disclaimer', 'disclaimer')->name('disclaimer');
    Route::get('/hot-jobs', 'hotJobs')->name('hotjobs.index');
    Route::get('/reviews', 'reviews')->name('reviews');
    Route::get('/admin-login', 'adminLogin')->name('admin.login.page');
    Route::get('/search-jobs', 'searchJobs')->name('jobs.search');
    Route::get('/post-resume', 'postResume')->name('resume.post');
    Route::get('/view-resumes', 'viewResumes')->name('resumes.view');
});

// API helper for cities
Route::get('api/cities', [LocationController::class, 'getCities']);
Route::get('/login', function () {
    return redirect()->route('home');
})->name('login');

// ----------------------------
// Candidate routes
// ----------------------------
Route::prefix('candidate')
    ->name('candidate.')
    ->group(function () {
        Route::middleware('guest')->group(function () {
            Route::get('login', [CandidateLoginController::class, 'showLoginForm'])->name('login.form');
            Route::post('login', [CandidateLoginController::class, 'login'])->name('login');
            Route::get('password/request', [CandidateLoginController::class, 'showForgotForm'])->name('password.request');
            Route::post('password/email', [CandidateLoginController::class, 'sendResetLink'])->name('password.email');
        });

        Route::middleware('auth')->group(function () {
            Route::get('dashboard', [CandidateController::class, 'dashboard'])->name('dashboard');
            Route::get('resume', [CandidateController::class, 'editResume'])->name('resume.edit');
            Route::post('resume', [CandidateController::class, 'updateResume'])->name('resume.update');
            Route::get('resume/view', [CandidateController::class, 'viewResume'])->name('view.resume');
            Route::get('resume/show', function () {
                return redirect()->route('candidate.view.resume');
            })->name('resume.view');
            Route::get('resume/hide', [CandidateController::class, 'hideResumeForm'])->name('resume.hide.form');
            Route::post('resume/hide', [CandidateController::class, 'hideResume'])->name('resume.hide');
             // Candidate banner jobs
            Route::get('jobs/search', [CandidateController::class, 'searchJobs'])->name('jobs.search');
            // Banner advertisement details (added)
            Route::get('banner-advertisements/{id}', [CandidateController::class, 'bannerAdvertisementDetails'])
                ->name('banner_advertisements.details');

          // Candidate hot jobs
            Route::get('jobs/hot', [CandidateController::class, 'hotJobs'])->name('jobs.hot');
            Route::get('jobs/{hotjob}', [CandidateController::class, 'showHotJob'])->name('jobs.show');
            Route::post('hotjobs/{hotjob}/apply', [CandidateController::class, 'applyHotJob'])
    ->name('hotjobs.apply');

            Route::get('express-service', [CandidateController::class, 'expressService'])->name('express.service');
            Route::get('statistics/applied', [CandidateController::class, 'statisticsApplied'])->name('statistics1');
            Route::get('statistics/viewed', [CandidateController::class, 'statisticsViewed'])->name('statistics2');
            Route::get('messages', [CandidateController::class, 'messages'])->name('messages');
            Route::get('profile/delete', [CandidateController::class, 'deleteProfile'])->name('profile.delete');
            Route::post('profile/delete/confirm', [CandidateController::class, 'confirmDelete'])->name('profile.delete.confirm');
            Route::post('logout', [CandidateLoginController::class, 'logout'])->name('logout');
        });
    });

// ----------------------------
// Admin routes
// ----------------------------
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::middleware('guest')->group(function () {
            Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login.form');
            Route::post('login', [AdminLoginController::class, 'login'])->name('login');
            Route::get('password/request', [AdminLoginController::class, 'showForgotForm'])->name('password.request');
            Route::post('password/email', [AdminLoginController::class, 'sendResetLink'])->name('password.email');
        });

        Route::middleware('auth:admin')->group(function () {
            Route::get('dashboard', function () {
                return view('admin.dashboard');
            })->name('dashboard');
            Route::resource('ranks', RankController::class);
            Route::resource('shiptypes', ShipTypeController::class);
            Route::resource('countries', CountryController::class);
            Route::resource('states', StateController::class);
            Route::resource('mobile-country-codes', MobileCountryCodeController::class)->names('mobile-country-codes');
            Route::resource('dce-endorsements', DceEndorsementController::class);
            Route::resource('course-certificates', CourseCertificateController::class);
            Route::resource('cities', CityController::class);
             // Candidate registration (for create/store only)
            Route::resource('candidates', CandidateRegistrationController::class)->except(['index', 'edit', 'update', 'destroy']);
            Route::post('candidates/validate', [CandidateRegistrationController::class, 'ajaxValidate'])->name('candidates.ajaxValidate');

            // Admin candidate management (index, edit, update, destroy)
            Route::get('candidates', [AdminCandidateController::class, 'index'])->name('candidates.index');
            Route::get('candidates/{id}/edit', [AdminCandidateController::class, 'edit'])->name('candidates.edit');
            Route::put('candidates/{id}', [AdminCandidateController::class, 'update'])->name('candidates.update');
            Route::delete('candidates/{id}', [AdminCandidateController::class, 'destroy'])->name('candidates.destroy');
            Route::get('/followups', [AdminCandidateController::class, 'followups'])->name('followups');

             // delete profile requests
            Route::get('candidate/delete-requests', [AdminCandidateController::class, 'deleteRequests'])->name('candidate.delete_requests.index');
            Route::get('candidate/delete-requests/{id}', [AdminCandidateController::class, 'showDeleteRequest'])->name('candidate.delete_requests.show');
            Route::post('candidate/delete-requests/{id}/process', [AdminCandidateController::class, 'processDeleteRequest'])->name('candidate.delete_requests.process');
            // Messages
            Route::get('messages', [MessageController::class, 'index'])->name('messages');
            Route::post('messages/send', [MessageController::class, 'send'])->name('messages.send');
            Route::get('messages/fetch', [MessageController::class, 'fetch'])->name('messages.fetch');
            Route::prefix('company')->name('company.')->group(function () {


                Route::get('register/{step?}', [CompanyRegisterController::class, 'showForm'])->name('register.step');
                Route::post('register/{step}', [CompanyRegisterController::class, 'handleStep'])->name('register.handle');
                Route::get('followups', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'followupsIndex'])->name('followups.index');
                Route::get('followups/create', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'followupsCreate'])->name('followups.create');
                Route::post('followups', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'followupsStore'])->name('followups.store');
                Route::get('{company}/adminlogins', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'adminLogins'])->name('adminlogins');
                Route::get('company/{company}/adminlogins/{user}/logs', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'showLoginLogs'])->name('adminlogins.logs');
                Route::get('/create', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'create'])->name('create');
                Route::post('/', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'store'])->name('store');
                Route::get('/{company}/superadmin/edit', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'editSuperadmin'])->name('superadmin.edit');
                Route::post('/{company}/superadmin/update', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'updateSuperadmin'])->name('superadmin.update');
                Route::get('/{company}/subadmins', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'editSubadmins'])->name('subadmins.edit');
                Route::post('/{company}/subadmins/update', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'updateSubadmins'])->name('subadmins.update');
                Route::get('banners', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'bannersIndex'])->name('banners.index');
                Route::get('/', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'index'])->name('index');
                Route::get('/{id}', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'show'])->name('show');
                Route::get('/{id}/edit', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'edit'])->name('edit');
                Route::put('/{id}', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'update'])->name('update');
                Route::delete('/{id}', [\App\Http\Controllers\Admin\Company\CompanyController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('hotjobs')->name('hotjobs.')->group(function () {
                Route::get('/', [HotjobsController::class, 'index'])->name('index');
                Route::get('/create', [HotjobsController::class, 'create'])->name('create');
                Route::post('/store', [HotjobsController::class, 'store'])->name('store');
                Route::get('/{hotjob}/edit', [HotjobsController::class, 'edit'])->name('edit');
                Route::put('/{hotjob}', [HotjobsController::class, 'update'])->name('update');
                Route::post('/{hotjob}/validate', [HotjobsController::class, 'validateHotjob'])->name('validate');
            });

            Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
        });
    });

// ----------------------------
// Company routes
// ----------------------------
Route::prefix('company')->name('company.')->group(function () {
    // Guest-only routes
    Route::middleware('guest:company')->group(function () {
        Route::get('login', [CompanyLoginController::class, 'showLoginForm'])->name('login.form');
        Route::post('login', [CompanyLoginController::class, 'login'])->name('login');
        Route::post('otp-verify', [CompanyLoginController::class, 'ajaxVerifyOtp'])->name('otp.verify');
    });

    // Authenticated company routes
    Route::middleware('auth:company')->group(function () {
        Route::get('dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');
        Route::post('logout', [CompanyLoginController::class, 'logout'])->name('logout');

        Route::get('search/candidates', [CompanyController::class, 'searchCandidates'])->name('search.candidates');

        // hotjobs management routes
        Route::prefix('hotjobs')->name('hotjobs.')->group(function () {
            Route::get('/', [CompanyController::class, 'hotjobsIndex'])->name('index');
            Route::get('/create', [CompanyController::class, 'hotjobsCreate'])->name('create');
            Route::post('/store', [CompanyController::class, 'hotjobsStore'])->name('store');
            Route::delete('/{hotjob}', [CompanyController::class, 'hotjobsDestroy'])->name('destroy');
        });
         // statistics management routes
        Route::get('statistics/applied', [CompanyController::class, 'applied'])
        ->name('statistics.applied');

        // Subadmin management routes
        Route::get('subadmins', [CompanyController::class, 'subadminList'])->name('subadmin.list');
        Route::get('subadmins/{subadmin}/edit', [CompanyController::class, 'editSubadmin'])->name('subadmin.edit');
        Route::put('subadmins/{subadmin}', [CompanyController::class, 'updateSubadmin'])->name('subadmin.update');
        Route::get('subadmins/{subadmin}/login-history', [CompanyController::class, 'subadminLoginHistory'])->name('subadmin.login-history');
        Route::get('messages', [CompanyMessageController::class, 'index'])->name('messages');
        Route::post('messages/send', [CompanyMessageController::class, 'send'])->name('messages.send');
        Route::get('messages/fetch', [CompanyMessageController::class, 'fetch'])->name('messages.fetch');
    });
});





