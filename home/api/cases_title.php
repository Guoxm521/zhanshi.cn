<?php
    include './fun.php';
    $mysql = new Mysql('sortclass');
    $sortname = $mysql->selectBygroup(['sortname'=>'案例中心'],true);
    $parentid = $sortname[0]['id'];
    $result = $mysql->selectBygroup(['parentid'=>$parentid],true);
    $data = [
        'code'=>1,
        'msg'=>'请求成功',
        'result'=>$result,
    ];
    // dump($data);
    echo json_encode($data,JSON_UNESCAPED_UNICODE);

?>