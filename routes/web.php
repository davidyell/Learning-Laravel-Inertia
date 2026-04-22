<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\PetsController as AdminPetsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/pets', [PetsController::class, 'index'])->name('pets.index');
Route::get('/pets/{id}', [PetsController::class, 'show'])->name('pets.show');

Route::get('/rescue', static fn () => Inertia::render('Rescue'))->name('page.rescue');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('animals', \App\Http\Controllers\Admin\PetsController::class)
        ->except(['index']);

    Route::get('/admin/pets', [AdminPetsController::class, 'index'])->name('admin.pets.index');
    Route::get('/admin/dashboard', DashboardController::class)->name('admin.dashboard');
});

require __DIR__.'/auth.php';
