<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\Sprint0Controller;

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


//* SECTION SCRAPER
Route::prefix('scraper')->name('scraper.')->group(function () {
    Route::get('/', [ScraperController::class, 'index'])->name('index');
    Route::get('/welcome', [ScraperController::class, 'welcome'])->name('welcome');
    Route::get('/keywords', [ScraperController::class, 'keywords'])->name('keywords');
    Route::get('/codes', [ScraperController::class, 'codes'])->name('codes');
    Route::get('/liste', [ScraperController::class, 'liste'])->name('liste');
});

//* SECTION SPRINT0
Route::get('/sprint0', [Sprint0Controller::class, 'demoListe'])->name('sprint0.liste');