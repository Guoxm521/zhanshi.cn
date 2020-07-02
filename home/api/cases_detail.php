<?php
    include './fun.php';
    if($_POST) {
        $sortname = $_POST['sortname'];
    }else {
        $sortname = "公司简介";
    }
    $mysql = new Mysql('about');
    $resutlt = $mysql->selectBygroup(['sortname'=>$sortname],true);
    $data = [
        'code'=>1,
        'msg'=>'查找成功',
        'data'=>$resutlt
    ];
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>