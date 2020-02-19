<?php

namespace Encore\BaiduMap;

use Encore\Admin\Admin;
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
        Admin::booting(function () {
            Admin::css('vendor/laravel-admin-ext/baidumap/map-init.css');
        });
    }
}
