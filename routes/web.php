<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('welcome');
});

Route::get("/articles", function () {
    return "Articles";
});

Route::get("/articles/detail", function () {
    return "Article Detail";
})->name("article.detail");

Route::get("/articles/more", function () {
    return redirect()->route("article.detail");
});

Route::get("/articles/detail/{id}", function ($id) {
    return "Article Detail - $id";
});

// Remark: Resource Route, View Route, Route Group 