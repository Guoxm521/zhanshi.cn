<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../index.css">
    <link rel="stylesheet" href="./../plugins/layui/layui/css/layui.css">
</head>

<body id="sortclasslist">
    <?php
    include './../fun.php';
    islogin();
    $mysql = new Mysql('sortclass');
    $db = $mysql->connectdb();
    $result = get_sortclass($parentid = 0, $db);
    $str = "";
    foreach ($result as $row) {
        $str .= "<tr>";
        $str .= "<td class='id'>" . $row["id"] . "</td>";
        $str .= "<td>" . $row["level"] . "</td>";
        $str .= "<td>" . $row["space"] . $row["sortname"] . "</td>";
        $str .= "<td>" . "<button class='add'>添加</button>";
        $str .= "<button class='modify'>修改</button>";
        $str .= "<button class='del'>删除</button>" . "</td>";
    }

    ?>
    <div id="action" class="clearfix">
        <div class="left">
            <button id="addtoplevel" style="width: 120px;height: 40px;">添加一级分类</button>
        </div>
    </div>
    <table cellspacing=0 border="1" cellpadding="5px">
        <thead>
            <tr style="height: 50px;font-size: 24px;">
                <th colspan="4">分类列表</th>
            </tr>
            <tr>
                <th style="width: 100px;">ID号</th>
                <th>层级</th>
                <th>类别名称</th>
                <th style="width: 250px;">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $str;
            ?>
        </tbody>
    </table>
    <script src="./../plugins/layui/layui/layui.js"></script>

    <script>
        layui.use(['layer', 'form'], function() {
            var layer = layui.layer,
                form = layui.form,
                $ = layui.jquery;
            $('#addtoplevel').on('click', function() {
                var parentid = 0;
                layer.prompt({
                    title: '请输入一级类型名称',
                    offset: '50px',
                    area: ['400px', '300px']
                }, function(text) {
                    var data = {
                        sortname: text,
                        parentid: parentid
                    };
                    $.ajax({
                        type: "post",
                        url: 'add_save.php',
                        data: data,
                        dataType: 'json',
                        success: function(res) {
                            layer.msg('添加成功')
                            if (res.code == 1) {
                                location.reload();
                            }
                            if(res.code == 3) {
                                layer.alert(res.msg)
                            }
                            layer.closeAll();
                        },
                        error:function(res) {
                            layer.alert(res.msg)
                        }
                    })
                })
            })
            
            // 添加按钮
            $('.add').on('click', function() {
                var id = $(this).parent().prev().prev().prev().text();
                layer.prompt({
                    title: '请输入类型名称',
                    offset: '50px',
                }, function(text) {
                    var data = {
                        sortname: text,
                        parentid: id
                    };
                    $.ajax({
                        type: "post",
                        url: 'add_save.php',
                        data: data,
                        dataType: 'json',
                        success: function(res) {
                            if (res.code == 1) {
                                location.reload();
                            }
                            if(res.code == 3) {
                                layer.alert(res.msg)
                            }
                            layer.closeAll();
                        },
                        error:function(res) {
                            layer.alert(res.msg)
                        }
                    })
                })
            })
            // 修改按钮
            $('.modify').on('click', function() {
                var id = $(this).parent().prev().prev().prev().text();
                layer.prompt({
                    title: '请输入新的类型名称',
                    offset: '50px'
                }, function(text) {
                    var data = {
                        sortname: text,
                        id: id
                    };
                    $.ajax({
                        type: 'get',
                        url: 'updata.php',
                        data: data,
                        dataType: 'json',
                        success: function(res) {
                            layer.msg(res.msg);
                            if (res.code == 1) {
                                location.reload()
                            }
                        },
                        error: function(res) {
                            layer.msg(res.msg);
                        }
                    });
                    layer.closeAll();
                });

            })
            // 删除按钮
            $('.del').on('click', function() {
                var id = $(this).parent().prev().prev().prev().text();
                layer.confirm('您确定删除吗？', {
                    btn: ['确定', '取消'] //按钮
                }, function() {
                    $.ajax({
                        type: 'get',
                        url: 'delete.php?id='+id,
                        dataType: 'json',
                        success: function(res) {
                            layer.msg(res.msg)
                            if (res.code == 1) {
                                location.reload();
                            }
                        },
                        error: function(res) {
                            if (res.code == 0) {
                                layer.msg(res.msg)
                            }
                        }
                    });
                    layer.closeAll();
                })
            })
        });
    </script>
</body>

</html>