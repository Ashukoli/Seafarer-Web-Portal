<?php
// ... keep the top of your file (imports/other route groups) as-is

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
use App\Http\Controllers\Admin\CandidateRegistrationController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Admin\Company\CompanyController;
use App\Http\Controllers\Admin\company\CompanyRegisterController;

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

    // Marketing-only login pages — keep separate names to avoid collisions with auth routes

    Route::get('/admin-login', 'adminLogin')->name('admin.login.page');
    //Route::get('/company/register', 'companyRegister')->name('company.register.page');

    // Marketing job/resume pages
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
// NOTE: Ensure CandidateController exists at App\Http\Controllers\Candidate\CandidateController
// ----------------------------
// Candidate routes
// ----------------------------
Route::prefix('candidate')
    ->name('candidate.')
    ->group(function () {

        // Guest-only (login / forgot)
        Route::middleware('guest')->group(function () {
            Route::get('login', [CandidateLoginController::class, 'showLoginForm'])
                ->name('login.form');
            Route::post('login', [CandidateLoginController::class, 'login'])
                ->name('login');
            Route::get('password/request', [CandidateLoginController::class, 'showForgotForm'])
                ->name('password.request');
            Route::post('password/email', [CandidateLoginController::class, 'sendResetLink'])
                ->name('password.email');
        });

        // Authenticated candidate routes
        Route::middleware('auth')->group(function () {

            // Dashboard
            Route::get('dashboard', [CandidateController::class, 'dashboard'])->name('dashboard');

            // Resume routes
            Route::get('resume', [CandidateController::class, 'editResume'])->name('resume.edit');
            Route::post('resume', [CandidateController::class, 'updateResume'])->name('resume.update');

            // View resume (read-only)
            Route::get('resume/view', [CandidateController::class, 'viewResume'])->name('view.resume');

            // Optional alias for backwards compatibility
            Route::get('resume/show', function () {
                return redirect()->route('candidate.view.resume');
            })->name('resume.view');

            Route::post('resume/hide', [CandidateController::class, 'toggleResumeVisibility'])->name('resume.hide');

            // Jobs / extra pages
            Route::get('jobs/search', [CandidateController::class, 'searchJobs'])->name('jobs.search');
            Route::get('jobs/hot', [CandidateController::class, 'hotJobs'])->name('jobs.hot');
            Route::get('express-service', [CandidateController::class, 'expressService'])->name('express.service');
            Route::get('statistics/applied', [CandidateController::class, 'statisticsApplied'])->name('statistics1');
            Route::get('statistics/viewed', [CandidateController::class, 'statisticsViewed'])->name('statistics2');
            Route::get('messages', [CandidateController::class, 'messages'])->name('messages');

            // Profile
            Route::post('profile/delete', [CandidateController::class, 'deleteProfile'])->name('profile.delete');

            // Logout
            Route::post('logout', [CandidateLoginController::class, 'logout'])->name('logout');
        });
    });

// ----------------------------
// Admin routes (unchanged) — keep your existing admin group below
// ----------------------------
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Admin login routes (guest only)
        Route::middleware('guest')->group(function () {
            Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login.form');
            Route::post('login', [AdminLoginController::class, 'login'])->name('login');
            Route::get('password/request', [AdminLoginController::class, 'showForgotForm'])->name('password.request');
            Route::post('password/email', [AdminLoginController::class, 'sendResetLink'])->name('password.email');
        });

        // Protected admin area
        Route::middleware('auth:admin')->group(function () {

            // Dashboard
            Route::get('dashboard', function () {
                return view('admin.dashboard');
            })->name('dashboard');

            // Master resources
            Route::resource('ranks', RankController::class);                 // admin.ranks.*
            Route::resource('shiptypes', ShipTypeController::class);         // admin.shiptypes.*
            Route::resource('countries', CountryController::class);          // admin.countries.*
            Route::resource('states', StateController::class);               // admin.states.*
            Route::resource('mobile-country-codes', MobileCountryCodeController::class)
                ->names('mobile-country-codes');                             // admin.mobile-country-codes.*
            Route::resource('dce-endorsements', DceEndorsementController::class);    // admin.dce-endorsements.*
            Route::resource('course-certificates', CourseCertificateController::class); // admin.course-certificates.*
            Route::resource('cities', CityController::class);                // admin.cities.*

            // Candidate registration
            Route::resource('candidates', CandidateRegistrationController::class);
            // Company routes
            Route::prefix('company')->name('company.')->group(function () {
                Route::get('register/{step?}', [CompanyRegisterController::class, 'showForm'])->name('register.step');
                Route::post('register/{step}', [CompanyRegisterController::class, 'handleStep'])->name('register.handle');
                Route::get('/', [CompanyController::class, 'index'])->name('index');
                Route::get('/create', [CompanyController::class, 'create'])->name('create');
                Route::post('/', [CompanyController::class, 'store'])->name('store');
                Route::get('/{id}', [CompanyController::class, 'show'])->name('show');
                Route::get('/{id}/edit', [CompanyController::class, 'edit'])->name('edit');
                Route::put('/{id}', [CompanyController::class, 'update'])->name('update');
                Route::delete('/{id}', [CompanyController::class, 'destroy'])->name('destroy');

                // Superadmin and Subadmin management
                Route::get('/{company}/superadmin/edit', [CompanyController::class, 'editSuperadmin'])->name('superadmin.edit');
                Route::post('/{company}/superadmin/update', [CompanyController::class, 'updateSuperadmin'])->name('superadmin.update');
                Route::get('/{company}/subadmins', [CompanyController::class, 'editSubadmins'])->name('subadmins.edit');
                Route::post('/{company}/subadmins/update', [CompanyController::class, 'updateSubadmins'])->name('subadmins.update');
            });
            // Logout
            Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
        });
    });


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
    });
});
