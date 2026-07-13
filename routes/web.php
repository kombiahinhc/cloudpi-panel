<?php

use Illuminate\Support\Facades\Route;
use App\Services\Docker\DockerService;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
    
Route::get('/docker-test', function (DockerService $docker) {

    dd($docker->containers());

});

Route::view('/docker', 'docker')
    ->middleware(['auth'])
    ->name('docker.index');

require __DIR__.'/auth.php';
