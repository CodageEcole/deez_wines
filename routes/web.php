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
Route::get('/scrape-welcome', [ScraperController::class, 'scrapeWelcome'])->name('scraper.accueil');
Route::get('/scrape-keywords', [ScraperController::class, 'scrapeKeywords'])->name('scraper.keywords');
Route::get('/scrape-codes', [ScraperController::class, 'scrapeCodes'])->name('scraper.codes');
Route::get('/scrape-liste', [ScraperController::class, 'scrapeListe'])->name('scraper.liste');
//Commentaire!

//* SECTION SPRINT0
Route::get('/sprint0', [Sprint0Controller::class, 'demoListe'])->name('sprint0.liste');