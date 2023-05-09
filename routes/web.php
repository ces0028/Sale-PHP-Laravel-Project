<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NoteInController;
use App\Http\Controllers\NoteOutController;
use App\Http\Controllers\FindProductController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\BestController;
use App\Http\Controllers\CrosstabController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PictureController;

Route::get('/', function () {
    return view('main');
});

Route::get('member', [MemberController::class, 'index']);
Route::resource('member', MemberController::class);

Route::resource('category', CategoryController::class);

Route::get('product/stock', [ProductController::class, 'check_stock']);
Route::resource('product', ProductController::class);

Route::resource('note_in', NoteInController::class);
Route::resource('note_out', NoteOutController::class);
Route::resource('find_product', FindProductController::class);
Route::resource('period', PeriodController::class);
Route::resource('best', BestController::class);
Route::resource('crosstab', CrosstabController::class);
Route::resource('chart', ChartController::class);

Route::post('login/check', [LoginController::class, 'check']);
Route::get('login/logout', [LoginController::class, 'logout']);

Route::resource('picture', PictureController::class);