<?php

namespace NawrasBukhari\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;
use NawrasBukhari\LaravelInstaller\Helpers\PermissionsChecker;

class PermissionsController extends Controller
{
    protected PermissionsChecker $permissions;

    public function __construct(PermissionsChecker $checker)
    {
        $this->permissions = $checker;
    }

    /**
     * Display the permissions check page.
     */
    public function permissions(): View
    {
        $permissions = $this->permissions->check(
            config('installer.permissions')
        );

        return view('vendor.installer.permissions', compact('permissions'));
    }
}
