<?php

namespace NawrasBukhari\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;
use NawrasBukhari\LaravelInstaller\Helpers\RequirementsChecker;

class RequirementsController extends Controller
{
    protected RequirementsChecker $requirements;

    public function __construct(RequirementsChecker $checker)
    {
        $this->requirements = $checker;
    }

    /**
     * Display the requirements page.
     */
    public function requirements(): View
    {
        $phpSupportInfo = $this->requirements->checkPHPversion(
            config('installer.core.minPhpVersion')
        );
        $requirements = $this->requirements->check(
            config('installer.requirements')
        );

        return view('vendor.installer.requirements', compact('requirements', 'phpSupportInfo'));
    }
}
