<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    //Route::get('/candidate-login', 'candidateLogin')->name('candidate.login.page');
    Route::get('/company-login', 'companyLogin')->name('company.login.page');
    Route::get('/admin-login', 'adminLogin')->name('admin.login.page');
    Route::get('/company/register', 'companyRegister')->name('company.register.page');

    // Marketing job/resume pages
    Route::get('/search-jobs', 'searchJobs')->name('jobs.search');
    Route::get('/post-resume', 'postResume')->name('resume.post');
    Route::get('/view-resumes', 'viewResumes')->name('resumes.view');
});


    Route::prefix('candidate')
    ->name('candidate.')   // ✅ Add this so all routes are prefixed with candidate.*
    ->group(function () {

        // Guest-only
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

        // Authenticated candidate
        Route::middleware('auth')->group(function () {
            Route::get('dashboard', [CandidateController::class, 'dashboard'])
                ->name('dashboard');   // ✅ Now becomes candidate.dashboard

            // ... other candidate routes ...

            Route::post('logout', [CandidateLoginController::class, 'logout'])
                ->name('logout');      // ✅ candidate.logout
        });
    });


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
            Route::get('candidates/create', [CandidateRegistrationController::class, 'create'])->name('candidates.create');

            Route::post('candidates', [CandidateRegistrationController::class, 'store'])->name('candidates.store');



            // Logout
            Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
        });
    });

