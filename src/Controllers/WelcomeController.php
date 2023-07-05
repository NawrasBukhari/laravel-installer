<?php

namespace NawrasBukhari\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    /**
     * Display the installer welcome page.
     */
    public function welcome(): View
    {
        return view('vendor.installer.welcome');
    }
}
