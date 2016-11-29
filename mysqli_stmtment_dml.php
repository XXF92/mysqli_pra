<?php
header("Content-type:text/html;charset=utf-8");

// 预处理进行dml操作

// 连接数据库
$mysqli = new mysqli('localhost','root','root','test');
if ($mysqli->connect_error) {
    die('connect failure '.$mysqli->connect_error);
}

$sql = 'insert into user2 (name,money) values (?,?)';
$name = '令狐冲';
$money = 2000;

// 开启预处理 返回一个mysqli_stmt对象
$mysqli_stmt =  $mysqli->prepare($sql);
var_dump($mysqli_stmt);

// 参数绑定
$mysqli_stmt->bind_param('si',$name,$money);

// 发送sql语句
$mysqli_stmt->execute();

// 处理结果
print_r('受影响行数为'.$mysqli_stmt->affected_rows);

    // 多次查询 ->可以用循环
        $name = '乔峰';
        $money = 3000;
        $mysqli_stmt->bind_param('si',$name,$money);
        $mysqli_stmt->execute();
        print_r('受影响行数为'.$mysqli_stmt->affected_rows);

// 关闭资源 mysqli_stmt对象
$mysqli_stmt->close();

// 关闭连接
$mysqli->close();