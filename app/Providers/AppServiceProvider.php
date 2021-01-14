<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $this->registerPolicies();
        Gate::define('manage-users', function ($user) {
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });
        Gate::define('manage-categories', function ($user) {
            return count(array_intersect(["ADMIN", "STAFF"], json_decode($user->roles)));
        });
        Gate::define('manage-books', function ($user) {
            return count(array_intersect(
                ["ADMIN", "STAFF"],
                json_decode($user->roles)
            ));
        });
        Gate::define('manage-orders', function ($user) {
            return count(array_intersect(
                ["ADMIN", "STAFF"],
                json_decode($user->roles)
            ));
        });
    }
}
