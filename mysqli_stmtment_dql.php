<?php
header("Content-type:text/html;charset=utf-8");
// 预处理进行 dql 操作

// 连接数据库
$mysqli = new mysqli('localhost','root','root','test');
if ($mysqli->connect_error) {
    die('connect failure '.$mysqli->connect_error);
}

$sql = 'select name,money from user2 where id>?';
$id = 10;

// 开启预处理
$mysqli_stmt = $mysqli->prepare($sql);
// 绑定参数
$mysqli_stmt->bind_param('i',$id);

// 发送查询
$mysqli_stmt->execute();

// 绑定结果
$mysqli_stmt->bind_result($name,$money);

// 循环取出结果
while ($mysqli_stmt->fetch()) {
    echo $name.'--'.$money.'<br/>';
}

    // 第二次
    echo "==================第二次====================<br/>";
    $id = 12;
    // 绑定参数
    $mysqli_stmt->bind_param('i',$id);
    // 发送查询
    $mysqli_stmt->execute();
    // 循环取出结果
    while ($mysqli_stmt->fetch()) {
        echo $name.'--'.$money.'<br/>';
    }


// 释放资源 关闭mysqli_stmt
$mysqli_stmt->free_result();
$mysqli_stmt->close();

// 关闭连接
$mysqli->close();