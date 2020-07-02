<?php
    include './fun.php';
    $mysql = new Mysql('about');
    $result = $mysql->selectAll();
    $data = [
        'code'=>1,
        'msg'=>'请求成功',
        'result'=>$result,
    ];
    // dump($data);
    echo json_encode($data,JSON_UNESCAPED_UNICODE);

?>