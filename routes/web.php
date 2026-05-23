<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
Route::view('/', 'pages.home');

Route::view('/tentang-rpl', 'pages.about');

Route::view('/persyaratan', 'pages.requirements');

Route::view('/faq', 'pages.faq');

Route::view('/pengumuman', 'pages.announcements');

Route::view('/login', 'pages.auth.login')
    ->name('login');

Route::view('/register', 'pages.auth.register');

/*
|--------------------------------------------------------------------------
| Protected Pages
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::view('/dashboard', 'pages.dashboard')
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Applicant Pages
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:applicant')
        ->prefix('applications')
        ->group(function () {

            Route::view(
                '/',
                'pages.applicant.applications'
            );

            Route::view(
                '/create',
                'pages.applicant.create'
            );
        });

    /*
    |--------------------------------------------------------------------------
    | Assessor Pages
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:assessor')
        ->prefix('assessments')
        ->group(function () {

            Route::view(
                '/',
                'pages.assessor.assessments'
            );
        });

    /*
    |--------------------------------------------------------------------------
    | Committee Pages
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:committee')
        ->prefix('approvals')
        ->group(function () {

            Route::view(
                '/',
                'pages.committee.approvals'
            );
        });

    /*
    |--------------------------------------------------------------------------
    | Staff Pages
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:staff')
        ->prefix('submissions')
        ->group(function () {

            Route::view(
                '/',
                'pages.staff.submissions'
            );
        });

    /*
    |--------------------------------------------------------------------------
    | Admin Pages
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:system_admin')
        ->prefix('admin')
        ->group(function () {

            /*
            |--------------------------------------------------------------------------
            | Master Data
            |--------------------------------------------------------------------------
            */
            Route::view(
                '/master-data',
                'pages.admin.master-data'
            );

            /*
            |--------------------------------------------------------------------------
            | User Management
            |--------------------------------------------------------------------------
            */
            Route::view(
                '/users',
                'pages.admin.users.index'
            );

            Route::view(
                '/users/create',
                'pages.admin.users.create'
            );

            Route::view(
                '/users/{id}/edit',
                'pages.admin.users.edit'
            );

            /*
            |--------------------------------------------------------------------------
            | Study Programs
            |--------------------------------------------------------------------------
            */
            Route::view(
                '/study-programs',
                'pages.admin.study-programs.index'
            );

            Route::view(
                '/study-programs/create',
                'pages.admin.study-programs.create'
            );

            Route::view(
                '/study-programs/{id}/edit',
                'pages.admin.study-programs.edit'
            );

            /*
            |--------------------------------------------------------------------------
            | Course Management
            |--------------------------------------------------------------------------
            */

            Route::view(
                '/courses',
                'pages.admin.courses.index'
            );

            Route::view(
                '/courses/create',
                'pages.admin.courses.create'
            );

            Route::view(
                '/courses/{id}/edit',
                'pages.admin.courses.edit'
            );
        });
});