<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        // theme jawa
        Blade::component('theme.jawa.components.layout', 'jawa.layout');
        Blade::component('theme.jawa.components.cover', 'jawa.cover');
        Blade::component('theme.jawa.components.hero', 'jawa.hero');
        Blade::component('theme.jawa.components.body', 'jawa.body');
        Blade::component('theme.jawa.components.gallery', 'jawa.gallery');
        Blade::component('theme.jawa.components.comment', 'jawa.comment');
        Blade::component('theme.jawa.components.gift', 'jawa.gift');

        // base
        Blade::component('base.components.layout', 'layout');
        Blade::component('base.components.cover', 'cover');
        Blade::component('base.components.hero', 'hero');
        Blade::component('base.components.body', 'body');
        Blade::component('base.components.gallery', 'gallery');
        Blade::component('base.components.comment', 'comment');
        Blade::component('base.components.gift', 'gift');

    }
}
