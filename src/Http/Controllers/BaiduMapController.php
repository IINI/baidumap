<?php

namespace Encore\BaiduMap\Http\Controllers;

use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class BaiduMapController extends Controller
{
    public function index(Content $content)
    {

        return $content
            ->title('BaiduMap')
            ->body(new Box('MAP',view('admin.map')));
    }
    public function point(){
        $machinelist = DB::table("machine")->get();
        foreach ($machinelist as &$item) {
            $item->machineid
                = $item->id;
            unset($item->id);
            $item->machinename = $item->machine_name;
            unset($item->machine_name);
            $item->machinenumber = $item->machine_number;
            unset($item->machine_number);
            unset($item->created_at);
            unset($item->updated_at);
        }
        unset($item);
        return json_decode($machinelist,JSON_UNESCAPED_UNICODE);
    }
}
