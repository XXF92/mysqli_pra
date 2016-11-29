<?php
header("Content-type:text/html;charset=utf-8");
// 使用mysqli扩展库 对CURD操作进行封装

class Helper_mysqli{
    // 以下参数可以使用配置文件导入
    private $host = 'localhost';
    private $user = 'root';
    private $psd = 'root';
    private $db = 'word';

    private $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli($this->host,$this->user,$this->psd,$this->db);
        if($this->mysqli->connect_error)
        {
            die('connect failuer'.$this->mysqli->connect_error);
        }else
        {
            echo "connect successfully<br/>";
            $this->mysqli->query('set names utf8');//php对数据库以utf-8的方式对数据库进行操作
        }
        
    }

    // dql操作
    public function execute_dql($sql)
    {
        $arr = array();
        $res = $this->mysqli->query($sql) or die("执行$sql语句失败".$this->mysqli->mysql_error);
        while ($row = $res->fetch_row()) {
            $arr[] = $row;
        }
        return $arr;//返回一个二维数组

        $res->free();//释放资源
    }

    //dml操作 
    public function execute_dml($sql)
    {
        $res = $this->mysqli->query($sql) or die("执行$sql语句失败".$this->mysqli->mysql_error);
        if(!$res)
        {
            return 0;//表示失败
        }
        else
        {
            if ($res == 0) {
                return 2;//表示没有行数受到影响
            }else
            {
                return 1;//表示成功
            }
        } 
    }
    
    // 关闭连接
    public function __destruct()
    {
        $this->mysqli->close();
    }



}

$link = new Helper_mysqli();

$sql = 'select * from words';//查询
$sql2 = "insert into words (enword,cnword) values ('pc','个人电脑')";//插入

$arr = $link->execute_dql($sql);
echo "<pre>";
print_r($arr);
echo "</pre>";

// $str = $link->execute_dml($sql2);
// echo $str;


