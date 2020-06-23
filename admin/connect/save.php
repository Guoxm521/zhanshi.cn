<?php
    include './../fun.php';
    $mysql = new Mysql('contact');
    $id = $_POST['index'];
    unset($_POST['index']);
    $count = $mysql->updata($id,$_POST);
    if($count) {
        $data = [
            'code'=>1,
            'msg'=>'修改成功'
        ];
    }else {
        $data = [
            'code'=>2,
            'msg'=>'修改失败'
        ];
    }
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
