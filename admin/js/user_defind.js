layui.define(["jquery", "layer"], function (exports) {
	$ = layui.jquery;
	var obj = {
		// 点击顶部的添加按钮 进行页面跳转   按钮id="add"
		add: function (url) {
			$("#add").on("click", function () {
				location.href = "add.php";
			});
		},
		// 全选反选单选事假  全选 id="selectAll" 单选class = "selectone"
		select: function () {
			$("#selectAll").on("click", function () {
				var flag = $(this).prop("checked");
				$(".selectone").prop("checked", flag);
			});
			$(".selectone").on("click", function () {
				if ($(".selectone:checked").length == $(".selectone").length) {
					$("#selectAll").prop("checked", true);
				} else {
					$("#selectAll").prop("checked", false);
				}
			});
		},
		// 点击删除事件   获取表单的id 发送ajax事件
		delete: function (url) {
			$("#del").on("click", function () {
				var arr = new Array();
				if ($(".selectone:checked").length == 0) {
					layer.msg("请选择一个文件进行删除", {
						offset: "50px",
						anim: 6,
						time: 1000,
					});
					return false;
				}
				$(".selectone:checked").each(function () {
					var id = $(this).val();
					arr.push(id);
				});
				$.ajax({
					type: "post",
					url: url,
					data: {
						ids: arr,
					},
					dataType: "json",
					success: function (res) {
						location.reload();
						if (res.code == 1) {
							layer.msg(res.msg, {
								time: 0,
							});
						}
						if (res.code == 2) {
							layer.alert(res.msg);
						}
					},
					error: function (res) {
						layer.msg("数据传送失败");
					},
				});
			});
		},
		// 点击修改事件
		modify: function (url) {
			$(".modify").on("click", function () {
				var id = $(this).val();
				location.href = url + "?id=" + id;
			});
		},
		// 图片山传实现实时预览
		showimg: function () {
			$("#files").on("change", function () {
				var file = $(this)[0].files[0];
				var name = file.name;
				var type = name.substr(name.lastIndexOf(".") + 1);
				if (type != "jpg" && type != "gif" && type != "jpeg" && type != "png") {
					layer.msg("请传入格式正确的图片");
					$(this).val("");
					return false;
				}
				var reader = new FileReader();
				reader.readAsDataURL(file);
				reader.onload = function () {
					$("#upload_img_show").attr("src", this.result);
				};
			});
		},
		// 加载页面获取分类   分类命名 id= search_select
		getsort: function (str) {
			$.ajax({
				url: "./../getsort.php?sortname=" + str,
				dataType: "json",
				success: function (res) {
					var str = "<option value=''>请选择</option>";
					for (var i = 0; i < res.length; i++) {
						str +=
							"<option value=" +
							res[i].sortname +
							">" +
							res[i].sortname +
							"</option>";
					}
					$("#search_select").html(str);
				},
			});
			// return false;
		},
		/* 
			搜索框搜索  
			name="name" id="search_input"
			name="sortclass" id="search_select"
			id="ser"
		*/
		search: function (url, type) {
			$("#ser").on("click", function () {
				var sch_input = $("#search_input").val();
				var sch_select = $("#search_select").val();
				var data = {};
				sch_input ? (data.title = sch_input) : "";
				sch_select ? (data.sortname = sch_select) : "";
				if (!data.sortname && !data.title) {
					layer.msg("请选择搜索内容");
					return false;
				}
				$.ajax({
					type: "post",
					url: url,
					data: data,
					dataType: "json",
					success: function (res) {
						var str = "";
						console.log(res);
						if (res.data) {
						} else {
							// 外加判断是否有查询得到数据
							layer.alert("未查询到数据？换个名字试试", {
								icon: "2",
								title: "提示",
							});
							return false;
						}
						for (var i = 0; i < res.data.length; i++) {
							var data = res.data[i];
							if (type == "news") {
								str += "<tr>";
								str +=
									"<td><input type='checkbox' value=" +
									data.id +
									" class='selectone'></td>";
								str += "<td>" + data.title + "</td>";
								str += "<td>" + data.sortname + "</td>";
								str += "<td>" + data.views + "</td>";
								str += "<td>" + formatdate(data.time) + "</td>";
								str +=
									"<td><button class='modify' value=" +
									data.id +
									">修改</button></td>";
							} else if (type == "about") {
								str +=
									"<td><input type='checkbox' value=" +
									data.id +
									" class='selectone'></td>";
								str += "<td>" + data.sortname + "</td>";
								str += "<td>" + data.content + "</td>";
								str += "<td>" + formatdate(data.time) + "</td>";
								str +=
									"<td><button class='modify' value=" +
									data.id +
									">修改</button></td>";
							} else {
								str += "<tr>";
								str +=
									"<td><input type='checkbox' value=" +
									data.id +
									" class='selectone'></td>";
								str += "<td>" + data.title + "</td>";
								str += "<td>" + data.sortname + "</td>";
								var path = "./../upload/" + data.img;
								str += "<td><img src=" + path + "></td>";
								str += "<td>" + data.views + "</td>";
								str += "<td>" + formatdate(data.time) + "</td>";
								str +=
									"<td><button class='modify' value=" +
									data.id +
									">修改</button></td>";
							}
						}
						// 判断来的类型  选择不一样的拼接方法

						$("tbody").html(str);
					},
				});
			});
		},
		/* 
			页面加载时发送ajax请求获得数据的条数，渲染成页码
		*/
		getpages:function(obj,url) {
			$.ajax({
				type:'post',
				url:url,
				data:obj,
				dataType:'json',
				success:function(res) {
					console.log(res)
				},
				error:function(err) {
					console.log(err);
				}
			});
		}
	};
	exports("user_defind", obj);
});
// 自定义格式化日期
function formatdate(time) {
	var date = new Date(time * 1000);
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
