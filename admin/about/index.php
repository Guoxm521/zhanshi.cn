<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./../plugins/layui/layui/css/layui.css">
    <link rel="stylesheet" href="./../index.css">
</head>

<body id="about">
    <?php
    include './../fun.php';
    islogin();
    $mysql = new Mysql('about');
    $result = $mysql->selectAll();
    $str = '';
    foreach ($result as $v) {
        $str .= "<tr>";
        $id = $v['id'];
        $str .= "<td><input value=$id type=" . "'checkbox'" . "class=" . "'selectone'" . "></td>";
        $str .= "<td>$v[sortname]</td>";
        $content = mb_substr($v['content'], 0, 200);
        $str .= "<td>$content</td>";
        $time = date('Y-m-d H:i:s', $v['time']);
        $str .= "<td>$time</td>";
        $str .= "<td><button class='modify' value=$id >修改</button></td>";
        $str .= "</tr>";
    }
    ?>
    <!-- 头部的搜索一栏 -->
    <div id="action" class="clearfix">
        <div class="left">
            <button id="add">添加</button>
            <button id="del">删除</button>
        </div>

        <div class="right">
            <select name="sortclass" id="search_select"">
                
            </select>
            <button id="ser">搜索</button>
        </div>
    </div>
    <!-- 中间表格栏 -->
    <table cellspacing=0 border="1" cellpadding="5px" style="text-align: center;">
        <thead>
            <tr>
                <th style="width: 40px;"><input type="checkbox" id="selectAll"></th>
                <th style="width: 90px;">名称</th>
                <th>摘要</th>
                <th style="width: 180px;">添加时间</th>
                <th style="width: 80px;">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $str;
            ?>
        </tbody>
    </table>
    <!-- 分页栏 -->
    <div id="pages">
        <ul>
            <li><a href="#">首页</a></li>
            <li><a href="#">
                    <</a> </li> <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">></a></li>
            <li><a href="#">尾页</a></li>
        </ul>
    </div>

    <script src="./../plugins/layui/layui/layui.js"></script>
    <script>
        layui.config({
            base: '/admin/js/' //假设这是你存放拓展模块的根目录
        })
        layui.use(['form', 'layer', 'user_defind'], function() {
            var form = layui.form,
                layer = layui.layer,
                $ = layui.jquery,
                user_defind = layui.user_defind;
            user_defind.select();
            user_defind.delete('./delete.php');
            user_defind.modify('./modify.php');
            user_defind.add('./add.php');
            user_defind.getsort('关于我们');
            user_defind.search('./search_and_page.php','about');
        
        })
    </script>
</body>

</html>