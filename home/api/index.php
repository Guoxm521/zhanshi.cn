<?php
    include './fun.php';
    $data = [
        'code'=>1,
        'msg'=>'成功',
    ];


    /* 
        每一个模块查询相应的数据出来
    */

    // 公司新闻
    $news_mysql = new Mysql('news');
    $news_result = $news_mysql->selectByPage(6,1,"where sortname='公司新闻'");
    foreach($news_result['result'] as  &$v) {
        unset($v['content']);
    };
    $data['news_result']=$news_result;
    // 行业动态
    $indu_result = $news_mysql->selectByPage(6,1,"where sortname='行业动态'");
    foreach($indu_result['result'] as  &$v) {
        unset($v['content']);
    };
    $data['indu_result']=$indu_result;
    // 产品知识
    $knol_result = $news_mysql->selectByPage(6,1,"where sortname='产品知识'");
    foreach($knol_result['result'] as  &$v) {
        unset($v['content']);
    };
    $data['knol_result']=$knol_result;
    //案例中心
    $cases_mysql = new Mysql('cases');
    $cases_result = $cases_mysql->selectByPage(4,1,"");
    $data['cases_result']=$cases_result;
    // 解决方案
    $solution_mysql = new Mysql('solution');
    $solution_result = $solution_mysql->selectByPage(8,1,"");
    $data['solution_result']=$solution_result;
 
    // 关于战石
    $about_mysql = new Mysql('about');
    $about_result = $about_mysql->selectByPage(1,1,"where sortname='公司简介'");
    $data['about_result']=$about_result;
    // 联系我们
    $contact_mysql = new Mysql('contact');
    $contact_result = $contact_mysql->selectByPage(1,1,"");
    $data['contact_result']=$contact_result;
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>