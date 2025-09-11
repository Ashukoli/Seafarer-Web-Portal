<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageController;

Route::controller(PageController::class)->group(function () {
    // Static / marketing
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
    // Auth / login pages (design views)
    Route::get('/candidate-login', 'candidateLogin')->name('candidate.login');
    Route::get('/company-login', 'companyLogin')->name('company.login');
    Route::get('/admin-login', 'adminLogin')->name('admin.login');
    Route::get('/company/register', 'companyRegister')->name('company.register');

    // Jobs / resumes
    Route::get('/search-jobs', 'searchJobs')->name('jobs.search');
    Route::get('/post-resume', 'postResume')->name('resume.post');
    Route::get('/view-resumes', 'viewResumes')->name('resumes.view');

    // Add more frontend routes here and map to PageController methods as needed.
});
