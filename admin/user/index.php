<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./../plugins/layui/layui/css/layui.css">
    <link rel="stylesheet" href="./../index.css">
    <style>
        table {
            width: 100%;
            border: 1px solid #666666;
            column-span: none;

        }

        td {
            text-align: center;
        }

        thead {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    include './../fun.php';
    islogin();
    $mysql = new Mysql('user');
    $result = $mysql->selectAll();
    $str = '';
    foreach ($result as $v) {
        $str .= "<tr>";
        $id = $v['id'];
        $str .= "<td>$v[username]</td>";
        $str .= "<td>$v[truename]</td>";
        $v['power'] == 0 ? $power = '普通群众' : $power = "超级管理员";
        $str .= "<td>$power</td>";
        $time = date('Y-m-d H:i:s', $v['time']);
        $str .= "<td>$time</td>";
        $str .= "<td><button class='modify' value=$id >修改</button><button class='delone' value=$id >删除</button></td>";
        $str .= "</tr>";
    }
    ?>
    <!-- 头部的搜索一栏 -->
    <!-- <div id="action" class="clearfix">
        <div class="left">
            <button id="add">添加</button>
            <button id="del">删除</button>
        </div>
        <div class="right">
            <input type="text" name="" id="">
            <input type="text" name="" id="">
            <input type="text" name="" id="">
            <button>搜索</button>
        </div>
    </div> -->
    <!-- 中间表格栏 -->
    <table cellspacing=0 border="1" cellpadding="5px">
        <thead>
            <tr>
                <th>用户名</th>
                <th>真实姓名</th>
                <th>权限</th>
                <th>添加时间</th>
                <th>操作</th>

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
            base: '/admin/js/'
        })
        layui.use(['form', 'layer'], function() {
            var form = layui.form,
                layer = layui.layer,
                $ = layui.jquery,
                user_defind = layui.user_defind;
            $('.delone').on('click', function() {
                var id = $(this).val();
                var ids = [id];
                layer.confirm('您确定删除吗？', {
                    btn: ['确定', '取消'] //按钮
                }, function() {
                    $.ajax({
                        type: 'post',
                        url: './delete.php',
                        data: {
                            ids: ids
                        },
                        dataType: 'json',
                        success: function(res) {
                            layer.msg(res.msg);
                            if (res.code == 1) {
                                location.reload();
                            }
                        }
                    })
                });

            })
            $('.modify').on('click', function() {
                var id = $(this).val();
                layer.open({
                    title:'权限修改',
                    btnAlign: 'c',
                    btn: ['超级管理员', '普通用户'],
                    yes: function(index, layero) {
                        $.ajax({
                            type:"get",
                            data:{
                                id:id,
                                power:1
                            },
                            url:'./modify_save.php',
                            success:function(res) {
                                layer.msg('修改成功')
                                location.reload()
                                console.log(res);
                            }
                        })
                    },
                    btn2: function(index, layero) {
                        $.ajax({
                            type:"get",
                            data:{
                                id:id,
                                power:0
                            },
                            url:'./modify_save.php',
                            success:function(res) {
                                layer.msg('修改成功')
                                location.reload()
                            }
                        })
                    },
                    cancel: function() {

                    }
                });
            })
        })
    </script>
</body>

</html>