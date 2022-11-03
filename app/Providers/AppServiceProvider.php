<?php

namespace App\Providers;

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
        $models = [
            'User',
        ];
        foreach ($models as $model) {
            app()->bind(
                'App\Repositories\\' . $model . 'Repository',
                'App\Repositories\Eloquent\DB' . $model . 'Repository'
            );
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadAssets();
    }

    public function loadAssets()
    {
        $theme = config('theme');
        $assets = $theme['assets'];

        $menu = config('menu');
        view()->share('cssFiles', $assets['css']);
        view()->share('jsFiles', $assets['js']);
        view()->share('menus', $menu);
    }
}
