<?php

declare(strict_types=1);

use App\Http\Controllers;
use App\Http\Controllers\AdoptionsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/pets', [Controllers\PetsController::class, 'index'])->name('pets.index');
Route::get('/pets/{id}', [Controllers\PetsController::class, 'show'])->name('pets.show');
Route::post('/pets/{id}/adopt', [AdoptionsController::class, 'store'])->name('pets.adopt');

Route::get('/rescue', static fn () => Inertia::render('Rescue'))->name('page.rescue');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', Controllers\Admin\DashboardController::class)->name('admin.dashboard');

    Route::resource('admin/pets', Controllers\Admin\Pets\PetsController::class)
        ->except(['index'])
        ->names('admin.pets');

    Route::get('/admin/pets', [Controllers\Admin\Pets\PetsController::class, 'index'])->name('admin.pets.index');
    Route::get('/admin/pets/{animal}', [Controllers\Admin\Pets\PetsController::class, 'show'])->name('admin.pets.show');
    Route::get('/admin/pets/{animal}/adoptions', [Controllers\Admin\Pets\AdoptionsController::class, 'show'])->name('admin.pets.adoptions.show');
});

require __DIR__.'/auth.php';
