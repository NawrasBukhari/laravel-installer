<?php

namespace NawrasBukhari\LaravelInstaller\Helpers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EnvironmentManager
{
    private string $envPath;

    private string $envExamplePath;

    /**
     * Set the .env and .env.example paths.
     */
    public function __construct()
    {
        $this->envPath = base_path('.env');
        $this->envExamplePath = base_path('.env.example');
    }

    /**
     * Get the content of the .env file.
     */
    public function getEnvContent(): string
    {
        if (! file_exists($this->envPath)) {
            if (file_exists($this->envExamplePath)) {
                copy($this->envExamplePath, $this->envPath);
            } else {
                touch($this->envPath);
            }
        }

        return file_get_contents($this->envPath);
    }

    /**
     * Get the .env file path.
     */
    public function getEnvPath(): string
    {
        return $this->envPath;
    }

    /**
     * Get the .env.example file path.
     */
    public function getEnvExamplePath(): string
    {
        return $this->envExamplePath;
    }

    /**
     * Save the edited content to the .env file.
     */
    public function saveFileClassic(Request $input): string
    {
        $message = trans('installer_messages.environment.success');

        try {
            file_put_contents($this->envPath, $input->get('envConfig'));
        } catch (Exception $e) {
            $message = trans('installer_messages.environment.errors');
        }

        return $message;
    }

    /**
     * Save the form content to the .env file.
     */
    public function saveFileWizard(Request $request): string
    {
        $results = trans('installer_messages.environment.success');

        $envFileData =
        'APP_NAME=\''.$request->get('app_name')."'\n".
        'APP_ENV='.$request->get('environment')."\n".
        'APP_KEY='.'base64:'.base64_encode(Str::random(32))."\n".
        'APP_DEBUG='.$request->get('app_debug')."\n".
        'APP_LOG_LEVEL='.$request->get('app_log_level')."\n".
        'APP_URL='.$request->get('app_url')."\n\n".
        'DB_CONNECTION='.$request->get('database_connection')."\n".
        'DB_HOST='.$request->get('database_hostname')."\n".
        'DB_PORT='.$request->get('database_port')."\n".
        'DB_DATABASE='.$request->get('database_name')."\n".
        'DB_USERNAME='.$request->get('database_username')."\n".
        'DB_PASSWORD='.$request->get('database_password')."\n\n".
        'BROADCAST_DRIVER='.$request->get('broadcast_driver')."\n".
        'CACHE_DRIVER='.$request->get('cache_driver')."\n".
        'SESSION_DRIVER='.$request->get('session_driver')."\n".
        'QUEUE_DRIVER='.$request->get('queue_driver')."\n\n".
        'REDIS_HOST='.$request->get('redis_hostname')."\n".
        'REDIS_PASSWORD='.$request->get('redis_password')."\n".
        'REDIS_PORT='.$request->get('redis_port')."\n\n".
        'MAIL_DRIVER='.$request->get('mail_driver')."\n".
        'MAIL_HOST='.$request->get('mail_host')."\n".
        'MAIL_PORT='.$request->get('mail_port')."\n".
        'MAIL_USERNAME='.$request->get('mail_username')."\n".
        'MAIL_PASSWORD='.$request->get('mail_password')."\n".
        'MAIL_ENCRYPTION='.$request->get('mail_encryption')."\n\n".
        'PUSHER_APP_ID='.$request->get('pusher_app_id')."\n".
        'PUSHER_APP_KEY='.$request->get('pusher_app_key')."\n".
        'PUSHER_APP_SECRET='.$request->get('pusher_app_secret');

        try {
            file_put_contents($this->envPath, $envFileData);
        } catch (Exception) {
            $results = trans('installer_messages.environment.errors');
        }

        return $results;
    }
}
