<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\MainController::class, 'index']);
// Route::get('contribute',[App\Http\Controllers\ContributionController::class,'contribute'])->name('form.contribute');
// Route::post('contribute',[App\Http\Controllers\ContributionController::class,'postContribution']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('{path}', [App\Http\Controllers\HomeController::class, 'index'])->where( 'path', "([A-z\d\-\/_.]+)?" );
