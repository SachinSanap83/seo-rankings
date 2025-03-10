<?php

use App\Http\Controllers\KeywordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Project Routes
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index'); // ✅ List all projects
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store'); // ✅ Store new project
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit'); // ✅ Edit project
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update'); // ✅ Update project
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy'); // ✅ Delete project

    // ✅ Place this after `/projects` to avoid conflicts
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show'); // ✅ Show single project

    // Keyword Routes
    Route::post('/projects/{project}/keywords', [KeywordController::class, 'store'])->name('keywords.store');

    // Rankings Routes
    Route::get('/rankings/{keyword}', [RankingController::class, 'index'])->name('rankings.index');
});


require __DIR__.'/auth.php';
