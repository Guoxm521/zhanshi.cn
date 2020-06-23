
// 格式化时间日期 
function formatTime(time) {
	var date = new Date(time);
	var y = date.getFullYear();
	var m = date.getMonth() + 1;
	if (m < 10) {
		m = "0" + m;
	}
	var d = date.getDate();
	var h = date.getHours();
	h = h < 10 ? "0" + h : h;
	var f = date.getMinutes();
	f = f < 10 ? "0" + f : f;
	var s = date.getSeconds();
	s = s < 10 ? "0" + s : s;
    var time = y + "-" + m + "-" + d + " " + h + ":" + f + ":" + s;
    return time;
}