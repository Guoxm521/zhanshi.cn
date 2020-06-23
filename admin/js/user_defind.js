layui.define(["jquery", "layer"], function (exports) {
	$ = layui.jquery;
	var obj = {
		// 点击顶部的添加按钮 进行页面跳转   按钮id="add"
		add:function(url) {
			$('#add').on('click', function() {
				location.href = 'add.php'
			})
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
							layer.msg(res.msg,{
								time:0
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
				location.href = url+"?id="+id;
			});
		},
		// 图片山传实现实时预览
		showimg:function() {
			$("#files").on('change',function() {
				var file = $(this)[0].files[0];
				var name = file.name;
				var type = name.substr(name.lastIndexOf('.')+1);
				if(type != "jpg" && type != "gif" && type !="jpeg" && type != "png") {
					layer.msg('请传入格式正确的图片');
					$(this).val("");
					return false;
				}
				var reader = new FileReader();
				reader.readAsDataURL(file);
				reader.onload = function() {
					$("#upload_img_show").attr('src',this.result)
				}
				
			})
		}
		
	};
	exports("user_defind", obj);
});
