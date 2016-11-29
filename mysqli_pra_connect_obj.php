<?php
header("Content-type:text/html;charset=utf-8");
// mysqli操作mysql数据库=》面向对象

// 1.创建myslqi对象
$link = new MySQli('localhost','root','root','word');
// 连接错误信息
if($link->connect_error)
{
    die('连接失败'.$link->connect_error);
}
else
{
    echo '连接成功.<br/>';
}

// 2.操作数据库 发送sql语句
$sql = "select * from words";
$res = $link->query($sql);
// $res 是一个对象:object(mysqli_result)#2 (5)
var_dump($res).'<br/>';

// 3.处理结果
while ($row = $res->fetch_row()) {
    foreach ($row as $value) {
        echo $value.' ';
    }
    echo "<br/>";
}

// 4.关闭资源
// 释放资源
$res->free();
// 关闭连接
$link->close();
