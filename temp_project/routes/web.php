<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/inventaire', function () {
    return view('inventaire.index');
});
Route::get('/entrees', function () {
    return view('entrees.index');
});
Route::get('/login', function () {
    return view('auth.login');
});