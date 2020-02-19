$(function () {
    $.ajax({
        type: "get",
        dataType: "JSON",
        url: "https://agileprintst.com/admin/machine/point",
        success: function (data) {

            var map = new BMap.Map("container");
            var point = new BMap.Point(106.633979, 26.388056);
            map.centerAndZoom(point, 17);  // 编写自定义函数，创建标注
            var myIcon = new BMap.Icon("https://agileprintst.com/vendor/laravel-admin-ext/baidumap/site.png", new BMap.Size(52, 94));
            var myIcon10 = new BMap.Icon("https://agileprintst.com/vendor/laravel-admin-ext/baidumap/ten_percent.png", new BMap.Size(52, 94));
            var myIcon20 = new BMap.Icon("https://agileprintst.com/vendor/laravel-admin-ext/baidumap/twenty_percent.png", new BMap.Size(52, 94));
            var myIcon50 = new BMap.Icon("https://agileprintst.com/vendor/laravel-admin-ext/baidumap/fifty_percent.png", new BMap.Size(52, 94));
            var myIcon80 = new BMap.Icon("https://agileprintst.com/vendor/laravel-admin-ext/baidumap/eighty_percent.png", new BMap.Size(52, 94));
            var myIcon98 = new BMap.Icon("https://agileprintst.com/vendor/laravel-admin-ext/baidumap/ninety_eight_percent.png", new BMap.Size(52, 94));
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

            function createIcon(datapaper) {
                var floar = datapaper / 4000;
                alert(floar);
                if (floar >= 0.98) {
                    return myIcon98;
                } else if (floar >= 0.8 && floar < 0.98) {
                    return myIcon80;
                } else if (floar >= 0.5 && floar < 0.8) {
                    return myIcon50;
                } else if (floar >= 0.2 && floar < 0.5) {
                    return myIcon20;
                } else if (floar >= 0.1 && floar < 0.2) {
                    return myIcon10;
                } else {
                    return myIcon;
                }
            }
        }
    });

});
