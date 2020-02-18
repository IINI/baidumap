<?php

namespace Encore\BaiduMap;

use Illuminate\Support\ServiceProvider;

class BaiduMapServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(BaiduMap $extension)
    {
        if (! BaiduMap::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'baidumap');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/baidumap')],
                'baidumap'
            );
        }

        $this->app->booted(function () {
            BaiduMap::routes(__DIR__.'/../routes/web.php');
        });
    }
}