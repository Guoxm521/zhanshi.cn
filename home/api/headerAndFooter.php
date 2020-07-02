<?php
    include './fun.php';
    /* 
        头部和底部导航栏
    */
    $mysql = new Mysql('sortclass');
    // 查询一级标题
    $arr = ['parentid'=>0];
    $f_title = $mysql->selectBygroup($arr,true);
    foreach($f_title as &$v) {
        $parentid =$v['id'];
        $arr = ['parentid'=>$parentid];
        $linkname = $v['linkname'];
        $s_title = $mysql->selectBygroup($arr,true);
        $v['s_title']=$s_title; 
    };  
    $data = [
        'code'=>1,
        'msg'=>'成功',
        'f_title'=>$f_title,
    ];
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>