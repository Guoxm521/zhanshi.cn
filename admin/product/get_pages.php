<?php
    include './../fun.php';
    /* 
        可能传来搜索的数据也可能没有 需要判断
    */
    $mysql = new Mysql('product');
    $total = $mysql->getpages($_POST);
    echo $total;
?>