<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\SitemapGenerator;

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
    return view('pages.welcome');
});

Auth::routes();

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


Route::get('/generate-sitemap', function () {
    $path = 'sitemap.xml';

    // Caching the sitemap generation for 60 minutes
    $sitemap = Cache::remember('sitemap', 60, function () use ($path) {
        SitemapGenerator::create('http://localhost/')
            ->writeToFile($path);
        return file_get_contents($path);
    });

    return response($sitemap)
        ->header('Content-Type', 'application/xml');
});
