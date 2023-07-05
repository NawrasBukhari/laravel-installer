<?php

use Illuminate\Support\Facades\Route;
use NawrasBukhari\LaravelInstaller\Controllers\DatabaseController;
use NawrasBukhari\LaravelInstaller\Controllers\EnvironmentController;
use NawrasBukhari\LaravelInstaller\Controllers\FinalController;
use NawrasBukhari\LaravelInstaller\Controllers\PermissionsController;
use NawrasBukhari\LaravelInstaller\Controllers\RequirementsController;
use NawrasBukhari\LaravelInstaller\Controllers\UpdateController;
use NawrasBukhari\LaravelInstaller\Controllers\WelcomeController;

Route::prefix('install')->as('LaravelInstaller::')->namespace('NawrasBukhari\LaravelInstaller\Controllers')->middleware(['web', 'install'])->group(function () {
    Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
    Route::get('environment', [EnvironmentController::class, 'environmentMenu'])->name('environment');
    Route::get('environment/wizard', [EnvironmentController::class, 'environmentWizard'])->name('environmentWizard');
    Route::post('environment/saveWizard', [EnvironmentController::class, 'saveWizard'])->name('environmentSaveWizard');
    Route::get('environment/classic', [EnvironmentController::class, 'environmentClassic'])->name('environmentClassic');
    Route::post('environment/saveClassic', [EnvironmentController::class, 'saveClassic'])->name('environmentSaveClassic');
    Route::get('requirements', [RequirementsController::class, 'requirements'])->name('requirements');
    Route::get('permissions', [PermissionsController::class, 'permissions'])->name('permissions');
    Route::get('database', [DatabaseController::class, 'database'])->name('database');
    Route::get('final', [FinalController::class, 'finish'])->name('final');
});

Route::prefix('update')->as('LaravelUpdater::')->namespace('NawrasBukhari\LaravelInstaller\Controllers')->middleware('web')->group(function () {
    Route::middleware('update')->group(function () {
        Route::get('/', [UpdateController::class, 'welcome'])->name('welcome');
        Route::get('overview', [UpdateController::class, 'overview'])->name('overview');
        Route::get('database', [UpdateController::class, 'database'])->name('database');
    });

    Route::get('final', [UpdateController::class, 'finish'])->name('final');
});
