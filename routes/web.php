<?php

use Illuminate\Support\Facades\Route;

/*
| Public Pages
*/
Route::view('/', 'pages.home');

Route::view('/login', 'pages.auth.login')
    ->name('login');

Route::view('/register', 'pages.auth.register');

/*
| Dashboard Only one endpoint but the views are
| differentiated by conditional role checking.
*/
Route::view('/dashboard', 'pages.dashboard')
    ->name('dashboard');

/*
| Applicant Pages
*/
Route::view('/applications', 'pages.applicant.applications');

Route::view('/applications/create', 'pages.applicant.create');

/*
| Assessor Pages
*/
Route::view('/assessments', 'pages.assessor.assessments');

/*
| Committee Pages
*/
Route::view('/approvals', 'pages.committee.approvals');

/*
| Staff Pages
*/
Route::view('/submissions', 'pages.staff.submissions');

/*
| Admin Pages
*/
Route::view('/users', 'pages.admin.users');

Route::view('/master-data', 'pages.admin.master-data');
