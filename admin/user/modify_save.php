<?php
    /* 
        数据更新
    */
    include './../fun.php';
    $id = $_GET['id'];
    $power =$_GET['power'];
    $arr =array('power'=>$power);
    $mysql = new Mysql('user');
    $result = $mysql->updata($id,$arr);
    if($result) {
        $data = [
            'code'=>1,
            'msg'=>'权限更新成功'
        ];
    } else {
        $data = [
            'code'=>2,
            'msg'=>'权限更新失败'
        ];
    }
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>