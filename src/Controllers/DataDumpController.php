<?php

namespace NawrasBukhari\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;

class DataDumpController extends Controller
{
    public function dump(): string
    {
        return __('installer_messages.data_dumped');
    }
}
