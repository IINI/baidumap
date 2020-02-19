Use BaiduMap in laravel-admin
======

Login using `admin/admin`

## Screenshot

![demo](https://github.com/IINI/baidumap/blob/master/demo.PNG)

## Installation

```bash
composer require laravel-admin-ext/baidumap

php artisan vendor:publish --tag=laravel-admin-baidumap
```
## Get BaiduApiAK

Open `http://lbs.baidu.com/apiconsole/key?application=key` to get ak code (using browser JavaScript API)
## Configuration

Open `config/admin.php`, add configurations that belong to this extension at `extensions` section.

```php

    'extensions' => [
       'baidumap' =>[
            // Set to `false` if you want to disable this extension
       
            'enable' => true,
            
            //Set relevant parameters of baidu map API
            //For the time being, this release only supports API version 3.0
            
            'config' =>[
            
                'https-enable'=> true,  //open api https
                'version' => '3.0',     //api version
                'baiduapiak' => 'L9MM6uPXHZFW3lKgE5dXUDFGqfqYGxxG'   //baidumap-api ak
                
            ]
        ]
    ]

```

## Usage

Create a view in views directory like `resources/views/admin/map.blade.php`, and add following codes:
```html
<div id="container" style="width:100%;height:1000px"></div>

@php
    $config = 'admin.extensions.baidumap.config'
@endphp

<script type="text/javascript"
        src="{{config("$config.https-enable")?'https':"http"}}://api.map.baidu.com/api?v={{config("$config.version")}}&ak={{config("$config.baiduapiak")}}">
</script>
@php
    $baidumap_enable = 'admin.extensions.baidumap';
    $path=config("$baidumap_enable.enable")?asset('vendor/laravel-admin-ext/baidumap/map-init.js'):'';
@endphp
<script type="text/javascript"
     src="{{$path}}"
>
</script>

```

add `BaiduMapController.php` in `App\Admin\Controllers`

```php
class BaiduMapController extends Controller
{
    public function index(Content $content)  //reture views
    {

        return $content
            ->title('BaiduMap')
            ->body(new Box('MAP',view('admin.map')));
    }
    public function point()                 //jQuery to use Ajax to get the location coordinates json
    {                    
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
```
Editing the `vendor/laravel-admin-ext/baidumap/map-init.js` file to customize marker and infowindow

```javascript

    $.ajax({
        type: "get",
        dataType: "JSON",
        url: "https://xxx.com/admin/map/point",    //自定义的获取地图标注点的经纬度(记住修改域名)
        success: function (data) {
            var res_url = 'https://xxx.com/vendor/laravel-admin-ext/baidumap/'; //获取自定义的标注图标的根路由(记住修改域名)
            var map = new BMap.Map("container");
            var point = new BMap.Point(106.633979, 26.388056);
            map.centerAndZoom(point, 17);  // 编写自定义函数，创建标注
            var myIcon = new BMap.Icon("site.png", new BMap.Size(52, 94));
            var myIcon10 = new BMap.Icon(res_url+"ten_percent.png", new BMap.Size(52, 94));//把图标实例化(图标建议使用50px*50px大小)
            //定义marker上面弹出的信息窗口

            map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
            var opts = {
                width: 300,     // 信息窗口宽度
                height: 200,     // 信息窗口高度
                title: "机器详情", // 信息窗口标题
                enableMessage: true//设置允许信息窗发送短息
            };
            for (i = 0; i <= data.length; i++) {
                var status = data[i].status == "1" ? "已连接" : "未连接";
                //定义信息窗口里面要显示的内容
                var content = "<div>";
                content += " <p>" + data[i].machinename + "</p>";
                content += "<p>剩余纸张数:" + data[i].hasa4 + "<br>机器状态：" + status + "<br><a href=''>添加纸张</a></p>";
                content += "</div>";
                //监听marker点击后 弹出信息框
                map.addOverlay(createMarker(new BMap.Point(data[i].longitude, data[i].latitude), {icon: createIcon(data[i].hasa4)}, content, opts))
            }

            function createMarker(point, icon, content, opts) {
                var markerx = new BMap.Marker(point, icon);
                markerx.addEventListener("click", function (e) {
                    this.openInfoWindow(new BMap.InfoWindow(content, opts,), point);
                });
                return markerx;
            }

            function createIcon(dataicon) {
              //根据获取的dataicon返回自定义的标注点图标
            }
        }
    });



```
License
------------
Licensed under [The MIT License (MIT)](LICENSE).
