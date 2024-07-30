<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckDirectAccess;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', CheckDirectAccess::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('menu', MenuController::class)->parameters(['menu' => 'id'])->names([
        'index' => 'menu.index',
        'show' => 'menu.show',
        'store' => 'menu.store',
        'destroy' => 'menu.destroy',
    ]);

    Route::resource('role', RoleController::class)->parameters(['role' => 'id'])->names([
        'index' => 'role.index',
        'show' => 'role.show',
        'store' => 'role.store',
        'destroy' => 'role.destroy',
    ]);

    Route::resource('user', UserController::class)->parameters(['user' => 'id'])->names([
        'index' => 'user.index',
        'show' => 'user.show',
        'store' => 'user.store',
        'destroy' => 'user.destroy',
    ]);
});

require __DIR__ . '/auth.php';
