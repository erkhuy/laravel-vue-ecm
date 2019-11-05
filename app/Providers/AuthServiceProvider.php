<?php

namespace App\Providers;

use App\Model\Backend\Permission;
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
        Gate::define('create-user', function ($user) {
            $user->hasAcess(['create-user']);
        });
        Gate::define('view-user', function ($user) {
            $user->hasAcess(['view-user']);
        });

        foreach (Permission::all() as $per) {
            Gate::define($per->name, function ($user) {
                $user->hasAcess([$per->name]);
            });

        }
    }
}