<?php
        include './../fun.php';
        $_POST['time']=time();
        $_POST['power']=0;
        $username = $_POST['username'];
        $_POST['password']=getEncypt($_POST['password']);
        $mysql = new Mysql('user');

        // 查询用户名是否被注册
        $arr = array("username"=>$username);
        $result = $mysql->selectBygroup($arr,true);
        if($result) {
            $data = [
                'code'=>2,
                'msg'=>'该用户名已经被注册，请输入新的用户名'
            ];
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            die();
        };
        $count = $mysql->insert($_POST);
        if($count) {
            $data = [
                'code'=>1,
                'msg'=>'数据添加成功'
            ];
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>