<?php

namespace App\Providers;

use App\Enums\UserLevel;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Gate::define('users-manager', function(User $user){
            return $user->level === UserLevel::Admin;
        });
    }
}
