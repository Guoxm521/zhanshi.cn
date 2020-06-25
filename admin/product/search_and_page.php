<?php
    include './../fun.php';
    $mysql = new Mysql('product');
    $result = $mysql->selectBygroup($_POST,false);
    if($result) {
        $data=[
            'code'=>1,
            'msg'=>'查询成功',
            'data'=>$result
        ];
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die();
    }
    else {
        $data=[
            'code'=>2,
            'msg'=>'查询失败，无匹配的内容',
        ];
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die();
    }
?>