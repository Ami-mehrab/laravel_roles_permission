<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//Route for permission 

     Route::get('/permissions/create', [PermissionController::class,'create'])->name('permissions.create');
     Route::post('/permissions', [PermissionController::class,'store'])->name('permissions.store');
     Route::get('/permissions/list', [PermissionController::class,'index'])->name('permissions.index');
     Route::get('/permissions/edit/{id}', [PermissionController::class,'edit'])->name('permissions.edit');
     Route::put('/permissions/{id}', [PermissionController::class,'update'])->name('permissions.update');
     Route::delete('/permissions', [PermissionController::class,'destroy'])->name('permissions.destroy');
     

//route for roles

     Route::get('/roles/create', [RoleController::class,'create'])->name('roles.create');
     Route::post('/roles', [RoleController::class,'store'])->name('roles.store');
     Route::get('/roles/list', [RoleController::class,'index'])->name('roles.index');
    });


require __DIR__.'/auth.php';
