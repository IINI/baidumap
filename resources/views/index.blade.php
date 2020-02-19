<div id="container" style="width:100%;height:1000px">

</div>
<style type="text/css">
    body, html, #container {
        width: 100%;
        height: 100%;
        overflow: hidden;
        margin: 0;
        font-family: "微软雅黑";
    }

    /*地图标题*/
    .BMap_pop div:nth-child(1) div {
        border-radius: 8px 0 0 0;
    }

    .BMap_pop div:nth-child(3) {
        border-radius: 0 9px 0 0;
        border-top: 1px solid #ababab;
        border-right: 1px solid #ababab;
        border-left: 1px solid white;
        width: 23px !important;
        height: 24px !important;
        background-color: white;
    }

    .BMap_pop div:nth-child(3) div {
        display: none;
    }

    .BMap_pop div:nth-child(5) div {
        border-radius: 0 0 0 8px;
    }

    .BMap_pop div:nth-child(7) {
        border-radius: 0 0 9px 0;
        border-right: 1px solid #ababab;
        border-bottom: 1px solid #ababab;
        border-left: 1px solid white;
        width: 23px !important;
        height: 24px !important;
        background-color: white;
    }

    .BMap_pop div:nth-child(7) div {
        display: none;
    }
</style>
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
