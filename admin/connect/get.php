<?php
    include './../fun.php';
    $mysql = new Mysql('contact');
    $result = $mysql->selectAll();
    $data = $result[0];

    echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>