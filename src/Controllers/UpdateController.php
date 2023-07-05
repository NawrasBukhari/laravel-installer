<?php

namespace NawrasBukhari\LaravelInstaller\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use NawrasBukhari\LaravelInstaller\Helpers\DatabaseManager;
use NawrasBukhari\LaravelInstaller\Helpers\InstalledFileManager;
use NawrasBukhari\LaravelInstaller\Helpers\MigrationsHelper;

class UpdateController extends Controller
{
    use MigrationsHelper;

    /**
     * Display the updater welcome page.
     */
    public function welcome(): View
    {
        return view('vendor.installer.update.welcome');
    }

    /**
     * Display the updater overview page.
     *
     * @return View
     */
    public function overview()
    {
        $migrations = $this->getMigrations();
        $dbMigrations = $this->getExecutedMigrations();

        return view('vendor.installer.update.overview', ['numberOfUpdatesPending' => count($migrations) - count($dbMigrations)]);
    }

    /**
     * Migrate and seed the database.
     */
    public function database(): RedirectResponse
    {
        $databaseManager = new DatabaseManager;
        $response = $databaseManager->migrateAndSeed();

        return redirect()->route('LaravelUpdater::final')
            ->with(['message' => $response]);
    }

    /**
     * Update installed file and display finished view.
     */
    public function finish(InstalledFileManager $fileManager): View
    {
        $fileManager->update();

        return view('vendor.installer.update.finished');
    }
}
