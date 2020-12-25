<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EmailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        config()->set('mail.from.address', config('global.mail_from_address'));
        config()->set('mail.from.name', config('global.mail_from_name'));
        config()->set('mail.default', config('global.mail_driver'));
        config()->set('mail.mailers.smtp.username', config('global.smtp_username'));
        config()->set('mail.mailers.smtp.password', config('global.smtp_password'));
        config()->set('mail.mailers.smtp.host', config('global.smtp_server'));
        config()->set('mail.mailers.smtp.port', config('global.smtp_port'));
    }
}
