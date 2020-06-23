<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Document</title>
	<link rel="stylesheet" href="./../plugins/layui/layui/css/layui.css" />
	<link rel="stylesheet" href="./../plugins/ueditor/themes/default/css/umeditor.css" />
	<link rel="stylesheet" href="./../index.css">
	<script src="./../plugins/ueditor/third-party/jquery.min.js"></script>
	<script src="./../plugins/ueditor/umeditor.config.js"></script>
	<script src="./../plugins/ueditor/umeditor.min.js"></script>
	<script src="./../plugins/ueditor/lang/zh-cn/zh-cn.js"></script>
</head>

<body>
	<?php
	include './../fun.php';
	$mysql = new Mysql('sortclass');
	$db = $mysql->connectdb();
	$result = select_sort($db, '新闻资讯');
	$str = '';
	foreach ($result as $v) {
		$str .= "<input type='radio' name='sortname' value='$v[sortname]' title='$v[sortname]'>";
	}
	?>
	<form class="layui-form" action="" style="width: 600px;margin-top:20px">
		<div class="layui-form-item">
			<label class="layui-form-label">标题</label>
			<div class="layui-input-block">
				<input type="text" name="title" required lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input" />
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">分类</label>
			<div class="layui-input-block">
				<?php
					echo $str;
				?>
			</div>
		</div>
		<div class="layui-form-item" id="img_upload">
			<label class="layui-form-label">照片</label>
			<div class="layui-input-block">
				<input type="file" name="img" id="files">
				<span>文件上传</span>
				<img src="" alt="" id="upload_img_show">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">内容</label>
			<div class="layui-input-block">
				<script type="text/plain" id="myEditor" style="width: 800px; height: 350px"></script>
			</div>
		</div>

		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit lay-filter="formDemo">
					立即提交
				</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</div>
	</form>
	<script src="./../plugins/layui/layui/layui.js"></script>
	<script>
		var um = UM.getEditor("myEditor");
		layui.config({
			base: '/admin/js/'
		});
		layui.use(["form", 'laydate', 'jquery', 'user_defind'], function() {
			var form = layui.form;
			var form = layui.form;
			var laydate = layui.laydate;
			var $ = layui.jquery;
			user_defind = layui.user_defind;
			user_defind.showimg();
			form.on('submit(formDemo)', function(data) {
				var data = data.field;
				var file_obj = document.getElementById('files').files[0];
				var formData = new FormData();
				formData.append('files', file_obj);
				formData.append('title', data.title);
				formData.append('content', getContent());
				formData.append('sortname', data.sortname);
				$.ajax({
					type: 'post',
					url: 'add_save.php',
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success: function(res) {
						layer.msg(1)
						layer.msg(res.msg)
						if (res.code == 1) {
							location.href = 'index.php'
						}
					},
					error: function(res) {
						layer.msg(res.msg)
					}
				})
				return false;
			});
		});
		function getContent() {
			var arr = [];
			arr.push(UM.getEditor("myEditor").getContent());
			return arr;
		}

		
	</script>
</body>

</html>