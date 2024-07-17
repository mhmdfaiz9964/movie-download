<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\DownloadLinkController;
use App\Http\Controllers\SubtitleController;
use App\Http\Controllers\FrontendController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/download-links/{id}', [FrontendController::class, 'show'])->name('download-links.show');




Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');
Route::post('/ads', [AdController::class, 'store'])->name('ads.store');
Route::get('/ads/{ad}/edit', [AdController::class, 'edit'])->name('ads.edit');
Route::put('/ads/{ad}', [AdController::class, 'update'])->name('ads.update');
Route::delete('/ads/{ad}', [AdController::class, 'destroy'])->name('ads.destroy');

Route::get('/download-links', [DownloadLinkController::class, 'index'])->name('download-links.index');
Route::get('/download-links/create', [DownloadLinkController::class, 'create'])->name('download-links.create');
Route::post('/download-links', [DownloadLinkController::class, 'store'])->name('download-links.store');
Route::get('/download-links/{id}', [DownloadLinkController::class, 'show'])->name('download-links.show');
Route::get('/download-links/{id}/edit', [DownloadLinkController::class, 'edit'])->name('download-links.edit');
Route::put('/download-links/{id}', [DownloadLinkController::class, 'update'])->name('download-links.update');
Route::delete('/download-links/{id}', [DownloadLinkController::class, 'destroy'])->name('download-links.destroy');
Route::post('/download-links/{id}/store-link', [DownloadLinkController::class, 'storeLink'])->name('download-links.storeLink');


Route::get('subtitles/create', [SubtitleController::class, 'create'])->name('subtitles.create');
Route::post('subtitles', [SubtitleController::class, 'store'])->name('subtitles.store');
Route::get('subtitles', [SubtitleController::class, 'index'])->name('subtitles.index');
Route::delete('subtitles/{subtitle}', [SubtitleController::class, 'destroy'])->name('subtitles.destroy');
