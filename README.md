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

License
------------
Licensed under [The MIT License (MIT)](LICENSE).
