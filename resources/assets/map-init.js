(function () {
    window.BMap_loadScriptTime = (new Date).getTime();
    document.write('<script type="text/javascript" src="https://api.map.baidu.com/api?v=3.0&ak=L9MM6uPXHZFW3lKgE5dXUDFGqfqYGxxG"></script>');
})();
var map = new BMap.Map("container");
var point = new BMap.Point(106.633979, 26.388056);
map.centerAndZoom(point, 17);  // 编写自定义函数，创建标注
var myIcon = new BMap.Icon("{{asset('vendor/qi/baidu-map/site.png')}}", new BMap.Size(52, 94));
var marker2 = new BMap.Marker(point, {icon: myIcon});  // 创建标注
map.addOverlay(marker2);
//1.使用经纬度进行精准定位

//定义marker上面弹出的信息窗口
var opts = {
    width: 300,     // 信息窗口宽度
    height: 200,     // 信息窗口高度
    title: "机器详情", // 信息窗口标题
    enableMessage: true//设置允许信息窗发送短息
};
//定义信息窗口里面要显示的内容
var content = "<div>"
content += " <p>位置机器测试一号</p>"
content += "<p>剩余纸张数:2000<br>机器状态：已连接<br><a href=''>添加纸张</a></p>";
content += "</div>";
//监听marker点击后 弹出信息框
marker2.addEventListener("click", function (e) {
    openInfo(content, point);
});

function openInfo(content, point) {

    var infoWindow = new BMap.InfoWindow(content, opts);  // 创建信息窗口对象
    map.openInfoWindow(infoWindow, point); //开启信息窗口
}

map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
