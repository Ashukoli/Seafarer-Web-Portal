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


    Route::prefix('candidate')->group(function () {
        Route::middleware('guest')->group(function () {
            Route::get('/candidate-login', [CandidateLoginController::class, 'showLoginForm'])->name('candidate.login.form');
            Route::post('login', [CandidateLoginController::class, 'login'])->name('candidate.login');
            Route::get('password/request', [CandidateLoginController::class, 'showForgotForm'])
                ->name('candidate.password.request');
            Route::post('password/email', [CandidateLoginController::class, 'sendResetLink'])
                ->name('candidate.password.email');
        });

        Route::prefix('candidate')->middleware('auth')->group(function () {
        // Dashboard
        Route::get('dashboard', [CandidateController::class, 'dashboard'])
            ->name('candidate.dashboard');

        // Change password page (view)
        Route::get('profile/change-password', [CandidateController::class, 'showChangePassword'])
            ->name('candidate.password.change');

        // Resume
        Route::get('resume', [CandidateController::class, 'resumeEdit'])
            ->name('candidate.resume');

        Route::get('resume/view', [CandidateController::class, 'resumeView'])
            ->name('candidate.view.resume');

        // Show hide-resume confirmation page (GET)
        Route::get('resume/hide', [CandidateController::class, 'showResumeHide'])
            ->name('candidate.resume.hide');

        // Hide resume action (POST)
        Route::post('resume/hide', [CandidateController::class, 'resumeHideAction'])
            ->name('candidate.resume.hide.confirm');

        // Jobs
        Route::get('jobs/search', [CandidateController::class, 'jobsSearch'])
            ->name('candidate.jobs.search');

        Route::get('jobs/hot', [CandidateController::class, 'jobsHot'])
            ->name('candidate.jobs.hot');

        // Express Service
        Route::get('express-service', [CandidateController::class, 'expressService'])
            ->name('candidate.express.service');

        // If you want a dedicated pay page for each service:
        Route::get('express-service/{service}/pay', [CandidateController::class, 'expressPayForm'])
            ->name('candidate.express.pay.form');

        Route::post('express-service/{service}/pay', [CandidateController::class, 'expressPayProcess'])
            ->name('candidate.express.pay');

        // Statistics
        Route::get('statistics/statistics1', [CandidateController::class, 'statistics1'])
            ->name('candidate.statistics1');

        Route::get('statistics/statistics2', [CandidateController::class, 'statistics2'])
            ->name('candidate.statistics2');

        Route::get('statistics/view-statistics', [CandidateController::class, 'statisticsView'])
            ->name('candidate.view-statistics');

        // Messages
        Route::get('messages', [CandidateController::class, 'messages'])
            ->name('candidate.messages');

        // TMWS Magazine: if you prefer redirect to external site:
        Route::get('tmws-magazine', function () {
            return redirect()->away('http://tmwsmagazine.com/magazine.php');
        })->name('candidate.tmws.magazine');

        // Profile delete (confirm view + action)
        Route::get('profile/delete', [CandidateController::class, 'showDeleteProfile'])
            ->name('candidate.profile.delete');

        Route::post('profile/delete', [CandidateController::class, 'deleteProfile'])
            ->name('candidate.profile.delete.confirm');

        // View resume (alternate legacy route)
        Route::get('view-resume', [CandidateController::class, 'resumeView'])
            ->name('candidate.view.resume.legacy');
        Route::post('logout', [CandidateLoginController::class, 'logout'])->name('candidate.logout');
    });
});


Route::prefix('admin')->name('admin.')->group(function () {

    // Guest-only admin routes (login / password request)
    Route::middleware('guest')->group(function () {
        // Show login form
        Route::get('login', [AdminLoginController::class, 'showLoginForm'])
            ->name('login.form');

        // Process login
        Route::post('login', [AdminLoginController::class, 'login'])
            ->name('login');

        // Forgot password (show + send)
        Route::get('password/request', [AdminLoginController::class, 'showForgotForm'])
            ->name('password.request');
        Route::post('password/email', [AdminLoginController::class, 'sendResetLink'])
            ->name('password.email');
    });

    // Authenticated admin routes (require auth middleware)
    // NOTE: use the guard you prefer; if you rely on default 'web' guard keep 'auth'.
    // If you use a custom guard for admin (e.g. 'auth:admin') replace 'auth' accordingly.
    Route::middleware('auth')->group(function () {

        // Dashboard
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Resourceful masters
        Route::resource('ranks', RankController::class);               // admin.ranks.*
        Route::resource('shiptypes', ShipTypeController::class);       // admin.shiptypes.*
        Route::resource('countries', CountryController::class);        // admin.countries.*
        Route::resource('states', StateController::class);             // admin.states.*
        Route::resource('mobile-country-codes', MobileCountryCodeController::class)
            ->names('admin.mobile-country-codes');
        // Logout
        Route::post('logout', [AdminLoginController::class, 'logout'])
            ->name('logout');
    });
});

