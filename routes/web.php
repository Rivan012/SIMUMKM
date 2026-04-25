<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\SettingController;
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

    Route::get('/web-settings', function(){
        return view('web.config');
    })->name('web-settings');

    Route::post('/web-settings',[SettingController::class,'store'])->name('web-settings.post');
});

require __DIR__.'/auth.php';
