<?php
    /* 
        新闻资讯添加保存
        post接受传递来的数据   
        也有文件传来
    */
    include './../fun.php';
    if($_FILES['files']) {
        $_POST['img']=fileup($_FILES['files']);
    } else {
        $_POST['img']='';
    }
    $_POST['time']=time();
    $_POST['views']=2989;
    $mysql = new Mysql('news');
    $count = $mysql->insert($_POST);
    if($count) {
        $data = [
            'code'=>1,
            'msg'=>'数据添加成功'
        ];
    } else {
        $data = [
            'code'=>2,
            'msg'=>'数据添加失败'
        ];
    }

    echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>