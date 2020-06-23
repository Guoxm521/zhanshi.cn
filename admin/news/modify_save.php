<?php
    include './../fun.php';
    $time = time();
    $_POST['time'] = $time;
    if($_FILES) {
        $_POST['img']=fileup($_FILES['files']);
    }
    $mysql = new Mysql('news');
    $count = $mysql->updata($_POST['id'],$_POST);
    if($count) {
        $data = [
            'code'=>1,
            'msg'=>'数据插入成功'
        ];
    }else {
        $dta = [
            'code'=>2,
            'msg'=>'数据插入失败'
        ];
    }
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>