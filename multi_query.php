<?php
header("Content-type:text/html;charset=utf-8");

// mysqli批量执行dql语句

// 连接数据库
$mysqli = new mysqli('localhost','root','root','sw');
if ($mysqli->connect_error) {
    die('connect failuer '.$mysqli->connect_error);
}
$mysqli->query('set names utf8');

// 发送查询
$sql = 'select * from sw_brand;';
$sql .= 'select * from sw_user;';
$sql .= 'select * from sw_category;';
$sql .= 'select * from sw_goods;';

// $results为各个查询语句的 结果集 的集合 判断是否查询成功 任意一条语句失败都返回false
if($results = $mysqli->multi_query($sql))
{
    // 循环取出每个结果集 用 next_result()（取下一个但不判断下一个有没有） 必须结合 more_results() 使用(判断是否有下个)
    do{

    // 循环输出每条结果集
    $res = $mysqli->store_result();

    while ($row = $res->fetch_row()) {
        foreach ($row as $key => $value) {
            echo "  $value  ";
        }
        echo "<br/>";
    }

// 及时释放资源$res
    $res->free();

// 判断是否有下个结果集
    if(!$mysqli->more_results())
    {
        break;
    }

        echo "=============下一条结果==============<br/>";

    }while($mysqli->next_result());//指针移到下个结果集

}
else
{
    die('查询出错'.$mysqli->error);
}

// 关闭连接
$mysqli->close();


echo "string";









