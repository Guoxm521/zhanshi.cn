<?php
    include './../fun.php';
    $mysql = new Mysql('user');
    $_POST['password']=getEncypt($_POST['password']);
    $result = $mysql->selectBygroup($_POST,true);
    if($result) {
        session_start();
        $_SESSION['username']=$result[0]['username'];
        $_SESSION['truename']=$result[0]['truename'];
        $_SESSION['power']=$result[0]['power'];
        $data = [
            'code'=>1,
            'msg'=>'登录成功'
        ];
    }else {
        $data = [
            'code'=>2,
            'msg'=>'登录失败，用户名或者密码错误'
        ];
    };
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>