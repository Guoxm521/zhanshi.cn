<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../index.css">
    <link rel="stylesheet" href="./../layui/layui/css/layui.css">
</head>

<body >
    <?php
    include './../fun.php';
    $parentid = isset($_GET['parentid']) ? $_GET['parentid'] : 0;
    ?>
    <div id="sortadd">
    <div>
        <li>类别名称：<input type="text" name="sortclass"></li>
        <li>
            <input type="hidden" value="<?php echo $parentid ?>" name="parentid">
            <input type="button" value="添加分类">
        </li>
    </div>
    </div>
    
    <script src="./../layui/layui/layui.js"></script>

    <script>
        layui.use(['layer', 'form'], function() {
            var layer = layui.layer,
                form = layui.form,
                $ = layui.jquery;
            $("input[type='button']").on('click', function() {
                var Sortname = $("input[type=text]").val();
                Sortname = $.trim(Sortname);
                var Parentid = $("input[type=hidden]").val();
                var data = {
                    sortname: Sortname,
                    parentid: Parentid,
                };
                if (Sortname) {
                    $.ajax({
                        type: "post",
                        url: 'add_save.php',
                        data: data,
                        dataType: 'json',
                        success: function(res) {
                            if (res.code == 1) {
                                location.href = 'index.php'
                            }

                        },
                        error: function(error) {
                            alert('发送失败')
                            console.log(error);
                        }
                    })
                } else {
                    layer.msg('请输入分类内容')
                }
            })
        });
    </script>
</body>

</html>