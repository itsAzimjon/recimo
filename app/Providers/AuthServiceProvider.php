<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('only-auth', function ($user, $id) {
            if($user->active == 1 && $user->role_id != 5){
                return $user->id == $id;
            }
        });
        
        Gate::define('admin', function ($user) {
            return $user->role_id == 1  ;
        });
        
        Gate::define('factory', function ($user) {
            return $user->role_id == 2;
        });
        
        Gate::define('agent', function ($user) {
            return $user->role_id == 3;
        });
        
        Gate::define('inspector', function ($user) {
            return $user->role_id == 4;
        });

        Gate::define('client', function ($user) {
            return $user->role_id == 5;
        });
        
    }
}
