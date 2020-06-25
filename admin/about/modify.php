<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="./../plugins/layui/layui/css/layui.css" />
    <link rel="stylesheet" href="./../index.css" />
    <title>Document</title>
</head>

<body>
    <?php
    include './../fun.php';
    // 获取分类
    $sortclass = new Mysql('sortclass');
    $sdb = $sortclass->connectdb();
    $sort_result = select_sort($sdb, '关于我们');

    // 根据id获取内容
    $about  = new Mysql('about');
    $about_result = $about->selectByids($_GET['id']);
    $sortname = $about_result['sortname'];

    $str ="<option value=''>请选择一个正确的类别</option>";
    foreach ($sort_result as $v) {
        $str .= "<option value=" . "'$v[sortname]'" . ">" . "$v[sortname]" . "</option>";
    }
    ?>
    <form class="layui-form" style="width: 600px; margin-top: 10px;">
        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="name" required lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input" value="<?php echo $about_result['name'] ?>" />
                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">类别</label>
            <div class="layui-input-block">
                <select name="sortname" lay-verify="required">
                    <?php
                    echo $str;
                    ?>
                    <!-- <option value="4">杭州</option> -->
                </select>
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block">
                <textarea name="content" placeholder="请输入内容" class="layui-textarea" style="height: 250px;"><?php echo $about_result['content'] ?></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo" id="tijiao">
                    立即提交
                </button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

    <script src="./../plugins/layui/layui/layui.js"></script>
    <script>
        layui.use(["form", "layer"], function() {
            var form = layui.form;
            var layer = layui.layer;
            var $ = layui.jquery;
            form.on("submit(formDemo)", function(data) {
                var data = data.field;
                $.ajax({
                    type: 'post',
                    url: 'modify_save.php',
                    data: data,
                    dataType: 'json',
                    success: function(res) {
                        layer.msg(res.msg);
                        if (res.code == 1) {
                            location.href = 'index.php'
                        }
                        if (res.code == 2) {
                            layer.alert(res.msg)
                        }
                    },
                    error: function(res) {
                        alert(2)
                        layer.msg('数据传送失败')
                    }
                })

                return false;
            });
        });
    </script>
</body>

</html>