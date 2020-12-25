<?php

namespace App\Providers;

use App\Models\Ticket;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::before(function (User $user) {
            return $user->isAdmin();
        });
        Gate::define('update-ticket', function ($user, Ticket $ticket) {
            return $user->id === $ticket->user_id;
        });
    }
}
