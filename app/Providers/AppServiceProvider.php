<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

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
        Paginator::useBootstrapFive();
        if(Schema::hasTable('categories')){
            View::share('categories', Category::orderBy('name')->get());
        }
    }

}
