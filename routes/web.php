<?php

use App\Http\Controllers\AssemblingController;
use App\Http\Controllers\DissmantlingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Assembling Route
    Route::get('/assembling', [AssemblingController::class, 'index'])->name('assembling');

    Route::get('/assembling/create', [AssemblingController::class, 'create'])->name('assembling.create');

    Route::post('/assembling/store', [AssemblingController::class, 'store'])->name('assembling.store');

    Route::get('/assembling/{assembling:slug}', [AssemblingController::class, 'edit'])->name('assembling.edit');

    Route::put('/assembling/update', [AssemblingController::class, 'update'])->name('assembling.update');

    Route::delete('/assembling/{assembling:slug}', [AssemblingController::class, 'destroy'])->name('assembling.delete');

    //Dissmantling Route
    Route::get('/dissmantling', [DissmantlingController::class, 'index'])->name('dissmantling');

    Route::get('/dissmantling/create', [DissmantlingController::class, 'create'])->name('dissmantling.create');

    Route::post('/dissmantling/store', [DissmantlingController::class, 'store'])->name('dissmantling.store');

    Route::get('/dissmantling/{dissmantling:slug}', [DissmantlingController::class, 'edit'])->name('dissmantling.edit');

    Route::put('/dissmantling/update', [DissmantlingController::class, 'update'])->name('dissmantling.update');

    Route::delete('/dissmantling/{dissmantling:slug}', [DissmantlingController::class, 'destroy'])->name('dissmantling.delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
