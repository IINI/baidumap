<?php

namespace Encore\BaiduMap\Http\Controllers;

use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;

class BaiduMapController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Title')
            ->description('Description')
            ->body(view('baidumap::index'));
    }
}