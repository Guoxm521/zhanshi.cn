<?php
    /* 数据删除  get接收id */
    include './../fun.php';
    $ids = $_POST['ids'];
    $mysql = new Mysql('user');
    $count = $mysql->deleteByids($ids);
    if($count) {
        $data = [
            'code'=>1,
            'msg'=>'数据删除成功'
        ];
    }else {
        $dta = [
            'code'=>2,
            'msg'=>'数据删除失败'
        ];
    }
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>