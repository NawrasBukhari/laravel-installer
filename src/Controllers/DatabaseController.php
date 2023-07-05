<?php

namespace NawrasBukhari\LaravelInstaller\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use NawrasBukhari\LaravelInstaller\Helpers\DatabaseManager;

class DatabaseController extends Controller
{
    private DatabaseManager $databaseManager;

    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Migrate and seed the database.
     */
    public function database(): RedirectResponse
    {
        $response = $this->databaseManager->migrateAndSeed();

        return redirect()->route('LaravelInstaller::final')
            ->with(['message' => $response]);
    }
}
