<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        Paginator::useBootstrap();

        // Gate filters and determins if a user is authrized to perform a give action.
        // To make the UI more dynamic and to show certain items to ADMINS only
        
        Gate::define('admin',function($user){
            return $user->role_id ===User::ADMIN_ROLE_ID;
        });
    }
}
