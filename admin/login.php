<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="./index.css" />
		<style></style>
		<title>Document</title>
	</head>
	<body id="loginpage">
		<div class="left">
			<div class="main">
				<header>
					<h1 id="title">
						后台登录
					</h1>
				</header>
				<!-- 登录 -->
				<form  id="login">
					<span>用户名：</span>
					<input
						type="text"
						name="username"
						id="username_l"
					/>
					<span>密码：</span>
					<input type="password" name="password" id="password_l" />
					<input type="button" id="login_btn" value="登录" />
					<p>
						<a href="#" class="modify_link">修改密码?</a
						><a href="#" class="register_link">注册新用户</a>
					</p>
				</form>
				<!-- 注册 -->
				<form action="" style="display: none;" id="register">
					<span>用户名：</span>
					<input
						type="text"
						name="username"
						id="username_r"
						required="required"
					/>
					<span>密码：</span>
					<input
						type="password"
						name="password"
						required="required"
						id="password_r"
					/>
					<span>真实姓名：</span>
					<input type="text" name="truename" id="truename_r" />
					<input type="submit" id="register_btn" value="注册" />
				</form>
				<!-- 修改密码 -->
				<form action="" id="changepassword" style="display: none;">
					<span>用户名：</span>
					<input type="text" name="username" id="username_c" />
					<span>原密码：</span>
					<input type="text" name="password_old" id="password_co" />
					<span>新密码：</span>
					<input type="text" name="password_new" id="password_cn" />
					<input type="button" id="changepassword_btn" value="修改" />
				</form>
			</div>
		</div>
		<div class="right"></div>
		<script src="./js/jquery-3.5.1.min.js"></script>
		<script>
			$(function () {
				// 修改密码
				$(".modify_link").on("click", function () {
					$("#login").css({ display: "none" });
					$("#register").css({ display: "none" });
					$("#changepassword").css({ display: "block" });
					$("#title").html("修改密码");
				});
				// 注册新用户
				$(".register_link").on("click", function () {
					$("#login").css({ display: "none" });
					$("#register").css({ display: "block" });
					$("#changepassword").css({ display: "none" });
					$("#title").html("注册新用户");
				});

				// 注册提交
				$("#register_btn").on("click", function () {
					var username = $("#username_r").val();
					var password = $("#password_r").val();
                    var truename = $("#truename_r").val();
                    var unreg = /^[a-z0-9_]{3,10}$/;
                    var pwreg = /^[a-z0-9_-]{6,18}$/;
                    console.log(unreg.test(username));
                    if(!unreg.test(username) || !pwreg.test(password)) {
                        alert('请输入正确的用户名和密码')
                        return false;
                    }
					var data = {
						username: username,
						password: password,
						truename: truename,
                    };

					$.ajax({
						type: "post",
						url: "login/register.php",
						data: data,
						dataType: "json",
						success: function (res) {
							alert(res.msg);
							if (res.code == 2) {
								$("#username_r").val("");
								$("#password_r").val("");
								$("#truename_r").val("");
							}
							if (res.code == 1) {
								location.reload();
							}
						},
					});
                });
                
                // 修改密码
                $('#changepassword_btn').on('click',function() {
                    var username = $("#username_c").val();
                    var password_o = $("#password_co").val();
                    var password_n = $("#password_cn").val();
                    var pwreg = /^[a-z0-9_-]{6,18}$/;
                    var unreg = /^[a-z0-9_]{3,10}/;
                    if(!pwreg.test(password_o) || !pwreg.test(password_n) || !unreg.test(username)) {
                        alert('请输入正确格式的密码和用户名')
                        return false;
                    }
					var data = {
						username: username,
						password_o: password_o,
						password_n: password_n,
                    };
                    $.ajax({
						type: "post",
						url: "login/changepwd.php",
						data: data,
						dataType: "json",
						success: function (res) {
							alert(res.msg);
							if (res.code == 1) {
								location.reload();
							}
						},
					});
                });
                // 登录提交
                $('#login_btn').on('click',function() {
                    var username = $("#username_l").val();
                    var password = $("#password_l").val();
                    var data = {
                        username:username,
                        password:password
                    };
                    var unreg = /^[a-z0-9_]{3,10}$/;
                    var pwreg = /^[a-z0-9_-]{6,18}$/;
                    if(!unreg.test(username) || !pwreg.test(password)) {
                        alert('请输入正确的用户名和密码')
                        return false;
                    };
                    $.ajax({
						type: "post",
						url: "login/login.php",
						data: data,
						dataType: "json",
						success: function (res) {
							// alert(res.msg);
							if (res.code == 1) {
								location.href = 'index.php';
							}
						},
					});
                })
			});
		</script>
	</body>
</html>
