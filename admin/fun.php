<?php
    // 数组打印
    function dump($arr) {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    };
    
    // 数据库类 
    class Mysql {
        // 默认属性
        private $host = 'localhost';
        private $user = 'root';
        private $password = 'root';
        private $dbname = 'zhanshi';
        private $table ;
        
        // 构造函数
        public function __construct($table){
            // 传入数据表
            $this->table = $table;
        }

        // 连接数据库
        public function connectdb() {
            $dns = "mysql:host=$this->host;dbname=$this->dbname";
            $db = new PDO($dns,$this->user,$this->password);
            $db->exec("SET name 'UTF8'");
            return $db;
        }
        /* 
            增加数据
            根据传入的数组，将数组转换拼接成字符串
            在将字符串拼接在sql语句上，执行插入数据库里面
        */
        public function insert($arr) {
            $str = "";
            // foreach($arr as $k =>$v) {
            //     $str .= $k .'='.'"'.$v.'"'.',';
            // }
            foreach($arr as $k =>$v) {
                $str .= $k .'='."'".$v."'".',';
            }
            $str = rtrim($str,',');
            $sql = "insert into $this->table set  $str";
            $db = $this->connectdb();
            $count = $db->exec($sql);
            return $count;
        }
        /* 
            数据查询  可能有多个查询条件   如id和属性  
            传递一个查询的调价数组
            查询又分为精确查询和模糊查询，则需要传入一个值，判断使用哪种查询方式
        */
        public function selectBygroup($arr,$type) {
            $str = '';
            if($type == true) {
                foreach($arr as $k=>$v) {
                    $str .= 'and'.' '.$k.'='.'"'."$v".'"'.' ';
                }
                $str = substr($str,4);
                $sql = "select * from $this->table where $str";
            }elseif($type == false) {
                foreach($arr as $k=>$v) {
                    $str .= " "."and".' '.$k.' '.'like'.' '.'"'."%$v%".'"';
                }
                $str = substr($str,4);
                $sql = "select * from $this->table where  $str";
            }
            $db = $this->connectdb();
            $query = $db->query($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $result = $query->fetchAll();
            return $result;
        }   

        /* 
            数据查找
            1.查找全部的数据
            2.根据id查找，id可以是一个值，也可以是一个数组
        */
        public function selectAll() {
            $sql = "select * from $this->table order by id asc";
            $db = $this->connectdb();
            $query = $db->query($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $result = $query->fetchAll();
            return $result;
        }
        public function selectByids($arr) {
            $sql = "select * from $this->table where id in($arr)";
            $db = $this->connectdb();
            $query = $db->query($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $result = $query->fetch();
            return $result;
        }
        /* 
            数据删除
            1.根据id逐个删除
            2.根据传入的id数组  批量删除
        */
        public function deleteByids($arr) {
            $arr = implode(',',$arr);
            $db = $this->connectdb();
            $sql = "delete from $this->table where id in($arr)";   
            $count = $db->exec($sql);
            return  $count;
        }
        /* 
            数据修改 传入id值 以及修改的内容
            修改内容使用数组的形式传入  方便多个值更改
        */
        public function updata($id,$arr) {
            $str = "";
            foreach($arr as $k=>$v) {
                $str .=$k.'='."'$v'".',';
            }
            $str = rtrim($str,',');//去除最右边的句号
            $db = $this->connectdb();
            $sql = "update $this->table set $str where id=$id";
            $result = $db->exec($sql);
            return $result;
        }
        /* 
            查询总数获得页码
        */
        public function getpages($arr) {
            if($arr) {
                $name = isset($arr['name'])?$_POST['name']:'';
                $sortclass = isset($arr['sortclass'])?$_POST['sortclass']:'';
                $search = '';
                $params = '';
                if($_POST['name']) {
                    $search .= " and name like '%$name%'";
                    $params .= "&name=$name";
                };
                if($_POST['sortname']) {
                    $search .= " and sortclass like '%$sortclass%'";
                    $params .= "&sortclass=$sortclass";
                 };
            };
            $mysql = new Mysql('product');
            $db = $mysql->connectdb();
            $sql = "select count(id) as t from $this->table $search";
            $query = $db->query($sql);
            $row = $query->fetch();
            $total = $row['t'];
            return $total;
        }
    
    }
    /* 
        类别添加展示页面
        函数名：get_sortclass
    */
    function get_sortclass($parentid=0,&$db,&$arr = array(),$space=" ",$level=0,$childResult = "") {
        // 第一次循环查询一级信息
        if(empty($childResult)) {
            $sql = "select * from sortclass where parentid = $parentid order by id asc";
            $query = $db->query($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $childResult = $query->fetchAll();
        }
        if($childResult) {
            foreach($childResult as $row) {
                if($level==0)$row["space"]=$space;
			    elseif($level==1)$row["space"]=$space="　　|---->";
                else $row["space"] = $space;
                $arr[]=$row;
                $parentid = $row["id"];
                $sql = "select * from sortclass where parentid = $parentid order  by id asc";
                $query = $db->query($sql);
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $childResult = $query->fetchAll();
                if($childResult) {
                    get_sortclass($parentid,$db,$arr,"　　|".$space,$level+1,$childResult);
                }
            }
        }
        return $arr;
    }
    /* 
        查询类别  $tablename 数据库名称 $name 父级id的名称
    */
    function select_sort($db,$name) {
        $sql = "select id from sortclass where sortname='$name' and parentid=0";
        $query = $db->query($sql);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $id = $query->fetch();
        $parentid = $id['id'];
        $sql = "select * from sortclass where parentid=$parentid order by id asc ";
        $query = $db->query($sql);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();
        return $result;
    }

    /* 
        图片上传
    */
    function fileup($_File) {
        $file = $_File;
        // 判断文件的大小
        if($file['size']>0) {
            if($file['size'] > 1024*1024) {
                echo "<script>alert('请选择正确的文件大小')</script>";
            }
            // 判断文件的类型
            $pos = strrpos($file['name'],'.');
            $ext = substr($file['name'],$pos+1);
            $all = ['jpg','jpeg','gif','png','jfif'];
            if(!in_array($ext,$all)) {
                echo "<script>alert('请传入正确的文件')</script>";
            };
            //防止文件重名
            $newname = time().rand(0,100).'.'.$ext;
            move_uploaded_file($file["tmp_name"],"./../upload/".$newname);
            return $newname;
        }
    }


    /* 
        密码加密
    */
    function getEncypt($password) {
        $password = md5($password);
        $password =sha1(substr($password,2,15));
        return $password;
    }

    /* 
        检测是否登录
    */
    function islogin() {
        session_start();
        if(!$_SESSION['username']) {
            echo "<script>parent.location.href='/admin/login.php';</script>";
            die();
        }
    }
?>