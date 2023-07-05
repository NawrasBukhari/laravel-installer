<?php

namespace NawrasBukhari\LaravelInstaller\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class canInstall
{
    /**
     * Handle an incoming request.
     *
     * @return RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($this->alreadyInstalled()) {
            $installedRedirect = config('installer.installedAlreadyAction');

            switch ($installedRedirect) {

                case 'route':
                    $routeName = config('installer.installed.redirectOptions.route.name');
                    $data = config('installer.installed.redirectOptions.route.message');

                    return redirect()->route($routeName)->with(['data' => $data]);

                case 'abort':
                    abort(config('installer.installed.redirectOptions.abort.type'));

                case 'dump':
                    $dump = config('installer.installed.redirectOptions.dump.data');
                    dd($dump);

                case '404':
                case 'default':
                default:
                    abort(404);
            }
        }

        return $next($request);
    }

    /**
     * If application is already installed.
     */
    public function alreadyInstalled(): bool
    {
        return file_exists(storage_path('installed'));
    }
}
