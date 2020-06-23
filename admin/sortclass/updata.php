<?php
    /* 
        数据更新
    */
    include './../fun.php';
    $id = $_GET['id'];
    $arr['sortname']=$_GET['sortname'];
    $mysql = new Mysql('sortclass');
    $result = $mysql->updata($id,$arr);
    if($result) {
        $data = [
            'code'=>1,
            'msg'=>'分类名称更新成功'
        ];
    } else {
        $data = [
            'code'=>2,
            'msg'=>'分类名称更新失败'
        ];
    }
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>