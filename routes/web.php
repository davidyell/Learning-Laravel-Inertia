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

    // Grouped admin routes
    Route::prefix('admin')
        ->middleware(['verified'])
        ->group(function () {
            Route::get('/dashboard', Controllers\Admin\DashboardController::class)->name('admin.dashboard');

            Route::resource('/pets', Controllers\Admin\Pets\PetsController::class)
                ->except(['index'])
                ->names('admin.pets');

            Route::get('/pets', [Controllers\Admin\Pets\PetsController::class, 'index'])->name('admin.pets.index');
            Route::get('/pets/{animal}', [Controllers\Admin\Pets\PetsController::class, 'show'])->name('admin.pets.show');
            Route::get('/pets/{animal}/adoptions', [Controllers\Admin\Pets\AdoptionsController::class, 'show'])->name('admin.pets.adoptions.show');
            Route::post('/pets/{animal}/adoptions/{adoption}/approve', [Controllers\Admin\Pets\AdoptionsController::class, 'approve'])->name('admin.pets.adoptions.approve');

            Route::get('/users', [Controllers\Admin\UsersController::class, 'index'])->name('admin.users.index');
            Route::get('/users/{user}', [Controllers\Admin\UsersController::class, 'show'])->name('admin.users.show');
            Route::patch('/users/{user}', [Controllers\Admin\UsersController::class, 'update'])->name('admin.users.update');
        });
});

require __DIR__.'/auth.php';
