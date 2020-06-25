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
        h1 {
            display: inline-block;
        } 
        h1:hover {
            cursor: pointer;
        }
        div {
            float: right;
        }
        body {
            padding: 17px 54px;
            background-color: #F2F2F2;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    
    <h1>后台管理页面</h1>
    <div style="font-size: 18px; text-align: center;">
        欢迎您，<span><?php session_start(); echo $_SESSION['truename'] ?></span><a href="#" style="margin-left: 10px;" id="logout">退出</a>
        <br>
        <span style="font-size: 14px;" id="time"></span>
    </div>

    <script src="./../js/jquery-3.5.1.min.js"></script>
    <script>
        var timel = document.querySelector('#time');
        setInterval(function(){
            var date = new Date();
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            if(m<10) {
                m="0"+m;
            }
            var d = date.getDate();
            var h = date.getHours();
            h = h<10?"0"+h:h;
            var f = date.getMinutes();
            f = f<10?'0'+f:f;
            var s = date.getSeconds();
            s = s<10?'0'+s:s;
            var time = y + '-' + m +'-'+d+' '+h+':'+f+':'+s;
            timel.innerHTML = time
        },1000)
        $('#logout').on('click',function() {
            $.ajax({
                type:'get',
                url:'./logout.php',
                data:{
                    exit:1
                },
                dataType:'json',
                success:function(res) {
                    parent.location.reload();
                }
            }) 
        })
        $('h1').on('click',function() {
            parent.location.reload();
        })
    </script>
</body>
</html>