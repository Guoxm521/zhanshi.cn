<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../plugins/layui/layui/css/layui.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            margin: 20px;
            background-color: #F2F2F2;
        }

        h1 {
            text-align: center;
            font-size: 32px;
        }

        #top {
            width: 800px;
            display: flex;
            /* background-color: red; */
            justify-content: space-between;
        }

        div[class^="card"] {
            flex: 0.32;
            height: 160px;
            padding: 24px 20px 8px;
            background-color: #fff;
            border-radius: 5px;
        }

        div[class^="card"] h3 {
            font-size: 18px;
            padding-bottom: 10px;
            border-bottom: 1px solid red;
        }

        div[class^="card"] p {
            font-size: 60px;
            text-align: center;
            margin-top: 15px;
            font-weight: 400;
        }
        #bottom {
            width: 800px;
            height: 400px;
            margin-top: 10px;
            border-radius: 5px;
            background-color: #fff;
        }
    </style>
</head>

<body>
    <?php
    include './../fun.php';
    islogin();
    session_start();
    ?>
    <h1>待添加。。。。</h1>
    <!-- <div id="top">
        <div class="card2">
            <h3>用户人数</h3>
            <p>25</p>
        </div>
        <div class="card3">
            <h3>访问量</h3>
            <p>2523</p>
        </div>
        <div class="card4">
            <h3>留言数目</h3>
            <p>635</p>
        </div>
    </div>
    <div id="bottom">
    
    </div> -->
    <script src="./../plugins/layui/layui/layui.js"></script>
    <script src="./../js/echarts.js"></script>
    <script type="text/javascript">
         var myChart = echarts.init(document.getElementById('bottom'));
         // 指定图表的配置项和数据
        var option = {
            title: {
                text: '新闻数量'
            },
            tooltip: {},
            legend: {
                data:['销量']
            },
            xAxis: {
                data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
            },
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data: [5, 20, 36, 10, 10, 20]
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
</body>

</html>