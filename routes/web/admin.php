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



Route::group(['middleware' => ['role:Super Admin']], function () {
    //
});

Route::group(['middleware' => ['role:Administrasi Umum']], function () {
    //
});

Route::group(['middleware' => ['role:TU Perencanaan']], function () {
    //
});

Route::group(['middleware' => ['role:Auditor']], function () {
    //
});

Route::group(['middleware' => ['role:Inspektur']], function () {
    //
});

Route::group(['middleware' => ['role:Tim Dupak']], function () {
    //
});