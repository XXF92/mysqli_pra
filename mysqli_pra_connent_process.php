<?php
header("Content-type:text/html;charset=utf-8");
// mysqli面向过程化操作=》了解
// 
// 1.建立mysqli连接
$link = mysqli_connect('localhost','root','root','word');
if (!$link) {
    die(mysqli_connect_error($link));
}
else
{
    echo "连接成功<br/>";
}


// 2.发送sql语句
$sql = 'select * from words';
$res = mysqli_query($link,$sql);
var_dump($res).'<br/>';

// 3.处理结果
while ($row = mysqli_fetch_row($res)) {
    foreach ($row as $key => $value) {
        echo $value."  ";
    }
    echo "<br/>";
}


// 4.关闭
// 释放资源
mysqli_free_result($res);
// 关闭连接
mysqli_close($link);