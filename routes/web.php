<?php

use App\Livewire\Websites\Index as WebsitesIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')
        ->middleware('verified')
        ->name('dashboard');

    Route::view('/profile', 'profile')
        ->name('profile');

    Route::view('/docker', 'docker')
        ->name('docker.index');

    Route::get('/websites', WebsitesIndex::class)
        ->name('websites.index');
});

require __DIR__ . '/auth.php';