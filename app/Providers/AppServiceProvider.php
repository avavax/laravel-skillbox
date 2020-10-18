<?php

namespace App\Providers;

use App\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        view()->composer('layout.sidebar', function($view) {
            $view->with('tagsCloud', Tag::has('posts')->get()->merge(Tag::has('news')->get()));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('admin', function() {
            return auth()->check() && auth()->user()->isAdmin();
        });

        Paginator::defaultSimpleView('pagination::simple-default');
    }
}
