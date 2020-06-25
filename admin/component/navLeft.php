<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        li {
            list-style: none;
            text-align: center;
            width: 100%;
            height: 50px;
            line-height: 50px;
        }
        li:hover {
            background-color: #08979c;
        }
        a {
            font-size: 16px;
            color: #fff;
            text-decoration: none;
            display: block;
            width: 100%;
            height: 100%;
        }
        body {
            background-color: #0050b3;
        }
    </style>
</head>
<body>
    <?php
        include './../fun.php';
        islogin();
    ?>
    <li><a href="./../user/index.php" target="main">用户列表</a></li>
    <li><a href="./../about/index.php" target="main">关于我们</a></li>
    <li><a href="./../cases/index.php" target="main">案例中心</a></li>
    <li><a href="./../solution/index.php" target="main">解决方案</a></li>
    <li><a href="./../product/index.php" target="main">产品中心</a></li>
    <li><a href="./../news/index.php" target="main">新闻资讯</a></li>
    <li><a href="./../connect/index.php" target="main">联系我们</a></li>
    <li><a href="./../sortclass/index.php" target="main">类别添加</a></li>

    <script src="./../js/jquery-3.5.1.min.js"></script>
    <script >
        $(function() {
            $('li').on('click',function() {
            $(this).css({"background-color":"#08979c"}).siblings().css({"background":"none"})
        })
        })
    </script>
</body>
</html>