<?php

namespace RachidLaasri\LaravelInstaller\Helpers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class EnvironmentManager
{
    /**
     * @var string
     */
    private $envPath;

    /**
     * @var string
     */
    private $envExamplePath;

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
     *
     * @return string
     */
    public function getEnvContent()
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
     * Get the the .env file path.
     *
     * @return string
     */
    public function getEnvPath()
    {
        return $this->envPath;
    }

    /**
     * Get the the .env.example file path.
     *
     * @return string
     */
    public function getEnvExamplePath()
    {
        return $this->envExamplePath;
    }

    /**
     * Save the edited content to the .env file.
     *
     * @param Request $input
     * @return string
     */
    public function saveFileClassic(Request $input)
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
     *
     * @param Request $request
     * @return string
     */
    public function saveFileWizard(Request $request)
    {
        $results = trans('installer_messages.environment.success');

        $envFileData =
        'APP_NAME=\''.$request->app_name."'\n".
        'APP_ENV='.$request->environment."\n".
        'APP_KEY='.'base64:'.base64_encode(Str::random(32))."\n".
        'APP_DEBUG='.$request->app_debug."\n".
        'APP_LOG_LEVEL='.$request->app_log_level."\n".
        'APP_URL='.$request->app_url."\n\n".
        'DB_CONNECTION='.$request->database_connection."\n".
        'DB_HOST='.$request->database_hostname."\n".
        'DB_PORT='.$request->database_port."\n".
        'DB_DATABASE='.$request->database_name."\n".
        'DB_USERNAME='.$request->database_username."\n".
        'DB_PASSWORD='.$request->database_password."\n\n".
        'BROADCAST_DRIVER='.'log'."\n".
        'CACHE_DRIVER='.'file'."\n".
        'SESSION_DRIVER='.'file'."\n".
        'QUEUE_DRIVER='.'sync'."\n\n".
        'MAIL_DRIVER='.'smtp'."\n".
        'MAIL_HOST='.'smtp.mailtrap.io'."\n".
        'MAIL_PORT='.'2525'."\n".
        'MAIL_USERNAME='.'null'."\n".
        'MAIL_PASSWORD='.'null'."\n".
        'MAIL_ENCRYPTION='.'null'."\n\n".
        'JWT_TTL='.'3600'."\n".
        'APP_READ_ONLY='.'false'."\n";

        try {
            file_put_contents($this->envPath, $envFileData);
            Artisan::call('jwt:secret');
        } catch (Exception $e) {
            $results = trans('installer_messages.environment.errors');
        }

        return $results;
    }
}
