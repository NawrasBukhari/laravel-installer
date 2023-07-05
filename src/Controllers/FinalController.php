<?php

namespace NawrasBukhari\LaravelInstaller\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use NawrasBukhari\LaravelInstaller\Events\LaravelInstallerFinished;
use NawrasBukhari\LaravelInstaller\Helpers\EnvironmentManager;
use NawrasBukhari\LaravelInstaller\Helpers\FinalInstallManager;
use NawrasBukhari\LaravelInstaller\Helpers\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     */
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment): Factory|View
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        event(new LaravelInstallerFinished);

        return view('vendor.installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}
