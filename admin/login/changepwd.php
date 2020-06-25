<?php
        include './../fun.php';
        $username = $_POST['username'];
        $password=getEncypt($_POST['password_o']);
        $mysql = new Mysql('user');

        // 查询用户名是否存在
        $arr = array("username"=>$username,"password"=>$password);
        $result = $mysql->selectBygroup($arr,true);
        if($result) {
            $id = $result['id'];
            $arr = array('password'=>getEncypt($_POST['password_n']));
            $mysql->updata($id,$arr);
            $data = [
                'code'=>1,
                'msg'=>'修改成功,请记住您的新密码'
            ];
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            die();
        }else {
            $data = [
                'code'=>2,
                'msg'=>'您输入的信息有误，请核对后再修改'
            ];
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            die();
        }
?>