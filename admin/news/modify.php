<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    // 获取分类
    $sortclass = new Mysql('news');
    $sdb = $sortclass->connectdb();
    $sort_result = select_sort($sdb, '新闻资讯');

    // 根据id获取内容
    $news  = new Mysql('news');
    $news_result = $news->selectByids($_GET['id']);
    $sortname_check = $news_result['sortname'];
    foreach ($sort_result as $v) {
        if($v['sortname'] == $sortname_check) {
            $str .= "<input type='radio' name='sortname' value='$v[sortname]' title='$v[sortname]' checked>";
        }else {
            $str .= "<input type='radio' name='sortname' value='$v[sortname]' title='$v[sortname]'>";
        }
        
    }
    ?>
    <form class="layui-form" style="width: 600px;">
        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" required lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input" value="<?php echo $news_result['title'] ?>">
                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">类别</label>
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
                <img src="<?php echo "./../upload/" . $news_result['img'] ?>" alt="" id="upload_img_show">
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
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
    <script src="./../plugins/layui/layui/layui.js"></script>
    <script>
        var um = UM.getEditor("myEditor");
        insertHtml();
        layui.config({
            base: '/admin/js/'
        });
        layui.use(['form', 'laydate', 'jquery', 'user_defind'], function() {
            var form = layui.form;
            var laydate = layui.laydate;
            var $ = layui.jquery;
            user_defind = layui.user_defind;
            user_defind.showimg();
            form.on('submit(formDemo)', function(data) {
                var data = data.field;
                var file_obj = document.getElementById('files').files[0];
                var formData = new FormData();
                if (file_obj) {
                    formData.append('files', file_obj);
                };
                console.log(file_obj);
                formData.append('title', data.title);
                formData.append('content', data.content);
                formData.append('sortname', data.sortname);
                formData.append('id', data.id);
                $.ajax({
                    type: 'post',
                    url: 'modify_save.php',
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(res) {
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

        function insertHtml() {
            um.execCommand("insertHtml", '<?php echo $news_result['content'] ?>');
        }
    </script>
</body>

</html>