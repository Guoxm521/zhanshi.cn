<?php
    /* 
        类别添加
        注意是否有父级id传入   
        如果没有的话   则是直接为0
    */
    include './../fun.php';
    $sortname = $_POST['sortname'];
    $parentid = $_POST['parentid'];
    $mysql = new Mysql('sortclass');
    
    // 判断在该父Id下是否有相同名称的类
    $arr = ['sortname'=>$sortname,'parentid'=>$parentid];
    $result = $mysql->selectBygroup($arr,true);
    
    if($result) {
        // echo "<script>location.href='add.php'; alert('类别名称已经存在，请更换类别名称')</script>";
        // die();
        $data = [
            'code'=>3,
            'msg'=>'类别名称已经存在，请更换类别名称'
        ];
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die();
    }
    
    // 父级等级
    if($parentid) {
        $result = $mysql->selectByids($parentid);
        if($result) {
            $level = $result[0]['level']+1;
        }
        else {
            echo "<script>alert('父类不存在');history.back();</script>";die();
        }
    } else  {
        $level = 0;
    }
    $arr['level']=$level;
    // 将信息插入到数据库当中
    $count = $mysql->insert($arr);
    if ($count) {
        $data = [
            'code'=>1,
            'msg'=>'添加成功'
        ];
    }else {
        $data = [
            'code'=>0,
            'msg'=>'添加失败'
        ];
    }
   echo json_encode($data,JSON_UNESCAPED_UNICODE);

?>