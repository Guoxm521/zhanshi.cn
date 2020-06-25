<?php
    /* 
        每个页面都有查询，查询中分类选项则从同一个表中查询
    */
    include './fun.php';
    $sortname = $_GET['sortname'];
    $mysql = new Mysql('sortclass');
    $db = $mysql->connectdb();
    $result = select_sort($db,$sortname);
    echo json_encode($result,JSON_UNESCAPED_UNICODE)
?>