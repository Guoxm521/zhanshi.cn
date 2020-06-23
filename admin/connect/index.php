<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../plugins/layui/layui/css/layui.css">
    
</head>

<body>
    <div style="width:600px; margin-top:15px">

        <div class="layui-form-item">
            <label class="layui-form-label">公司名称</label>
            <div class="layui-input-block">
                <input type="text" name="company" disabled lay-verify="required" class="layui-input" value="nihao">
                <input type="hidden" name="index">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">电话</label>
            <div class="layui-input-block">
                <input type="text" name="tel" disabled lay-verify="required" class="layui-input" value="nihao">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">联系人</label>
            <div class="layui-input-block">
                <input type="text" name="linkman" disabled lay-verify="required" class="layui-input" value="nihao">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
                <input type="text" name="email" disabled lay-verify="required" class="layui-input" value="nihao">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">地址</label>
            <div class="layui-input-block">
                <input type="text" name="address" disabled lay-verify="required" class="layui-input" value="nihao">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn layui-bg-red" lay-submit lay-filter="formDemo" id="change">修改</button>
                <button type="reset" class="layui-btn layui-btn-primary" id="save">保存</button>
            </div>
        </div>
    </div>
    <script src="./../plugins/layui/layui/layui.js"></script>
    <script>
        layui.use(['layer', 'jquery'], function() {
            var layer = layui.layer,
                $ = layui.jquery;
            $.ajax({
                type: 'get',
                url: 'get.php',
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $('input[name=index]').val(res.id);
                    $('input[name=company]').val(res.company);
                    $('input[name=tel]').val(res.tel);
                    $('input[name=linkman]').val(res.linkman);
                    $('input[name=email]').val(res.email);
                    $('input[name=address]').val(res.address);
                }
            })
            $('#change').on('click', function() {
                $(this).removeClass('layui-bg-red');
                $('input').attr('disabled', false);
            })
            $('#save').on("click", function() {
                var index = $('input[name=index]').val();
                var company = $('input[name=company]').val();
                var tel = $('input[name=tel]').val();
                var linkman = $('input[name=linkman]').val();
                var email = $('input[name=email]').val();
                var address = $('input[name=address]').val();
                var data = {
                    index:index,
                    company:company,
                    tel:tel,
                    linkman:linkman,
                    email:email,
                    address:address
                };
                $.ajax({
                    type:"post",
                    url:'./save.php',
                    data:data,
                    dataType:'json',
                    success:function(res){
                        layer.msg(res.msg);
                        location.reload();
                    },
                    error:function(res) {
                    }
                })
                return false;
            })
        })
    </script>
</body>

</html>