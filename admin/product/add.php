<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./../plugins/layui/layui/css/layui.css">
  <link rel="stylesheet" href="./../index.css">
</head>

<body>
  <?php
  include './../fun.php';
  islogin();
  $mysql = new Mysql('sortclass');
  $db = $mysql->connectdb();
  $result = select_sort($db, '产品中心');
  $str = '<option value="">请选择</option>';
  foreach ($result as $v) {
    $str .= "<option value=" . "'$v[sortname]'" . ">" . "$v[sortname]" . "</option>";
  }
  ?>
  <form class="layui-form" style="width: 600px;">
    <div class="layui-form-item">
      <label class="layui-form-label">标题</label>
      <div class="layui-input-block">
        <input type="text" name="title" required lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">类别</label>
      <div class="layui-input-block">
        <select lay-verify="required" name="sortname">
          <?php
          echo $str;
          ?>
        </select>
      </div>
    </div>
    <div class="layui-form-item" id="img_upload">
      <label class="layui-form-label">照片</label>
      <div class="layui-input-block">
        <input type="file" name="img"  id="files">
        <span>文件上传</span>
        <img src="" alt="" id="upload_img_show">
      </div>
    </div>
    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">文本域</label>
      <div class="layui-input-block">
        <textarea name="content" placeholder="请输入内容" class="layui-textarea"></textarea>
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
        formData.append('files', file_obj);
        formData.append('title', data.title);
        formData.append('content', data.content);
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
            layer.msg(res.msg)
            if(res.code ==1) {
              location.href = 'index.php'
            }
          },
          error:function(res) {
            layer.msg(res.msg)
          }
        })
        return false;
      });
    });
  </script>
</body>

</html>