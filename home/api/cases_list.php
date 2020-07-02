<?php
    include './fun.php';
    if($_POST) {
        $sortname = $_POST['sortname'];
        $page= $_POST['page'];
    };
    if($sortname) {
        $ser = 'where sortname='."'$sortname'";
    }else {
        $ser='';
    };
    $page = $page ? $page :1;
    $mysql = new Mysql('cases');
    $resutlt = $mysql->selectByPage(12,$page,$ser);
    $data = [
        'code'=>1,
        'msg'=>'查找成功',
        'data'=>$resutlt
    ];
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>