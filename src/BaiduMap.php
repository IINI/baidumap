<?php

namespace Encore\BaiduMap;

use Encore\Admin\Extension;

class BaiduMap extends Extension
{
    public $name = 'baidumap';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $menu = [
        'title' => 'Baidumap',
        'path'  => 'baidumap',
        'icon'  => 'fa-gears',
    ];
}