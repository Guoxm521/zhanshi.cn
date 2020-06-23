<?php
    /* 
        删除数据 
        传入id值即可

        注意：这里因为类型有层级关系   我们不可以直接删除父级元素，所以删除前需要判断子元素有没有
    */
    include './../fun.php';
    $id = $_GET['id'];
    $mysql = new Mysql('sortclass');
    
    // 将传入的id看做parentid
    $arr = array();
    $arr['parentid'] = $id;

    $result = $mysql->selectBygroup($arr,true);//精确查找
    if($result) {
        $data=[
            'code'=>2,
            'msg'=>'注意：改类别下有子类存在，删除失败'
        ];
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die();
    }
    $count = $mysql->deleteByids($_GET);
    if($count) {
        $data=[
            'code'=>1,
            'msg'=>'删除成功'
        ];
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die();
    }

?>