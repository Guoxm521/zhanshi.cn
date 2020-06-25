<?php
    /* 
        退出删除sessionid
    */
    include './../fun.php';
    session_start();
    session_destroy();
    $data = [
        'code'=>1
    ];
    // echo "<script>alert('安全退出');parent.location.href = '/admin/login.html';</script>";
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>