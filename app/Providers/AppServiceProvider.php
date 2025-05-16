<?php

namespace App\Providers;

use App\Models\UserPosts;
use App\Observers\UserPostsObserver;
use Illuminate\Support\ServiceProvider;

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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        UserPosts::observe(UserPostsObserver::class);
    }
}
