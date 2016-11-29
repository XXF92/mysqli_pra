<?php
header("Content-type:text/html;charset=utf-8");
// 练习使用mysqli打印表格

/**
 * [mysqli_print_table 打印一个表格的数据和其列信息]
 * @param  [type] $tableName [表名]
 * 
 */
function mysqli_print_table($tableName)
{
    echo "<br/>============================================================================================================================================<br/>";
    // 连接数据库
    $mysqli = new mysqli('localhost','root','root','sw');
    if ($mysqli->connect_error) {
        die('connect failuer'.$mysqli->connect_error);
    }

    $table = $tableName;
    $sql = 'select * from '.$table.';';
    $sql .= 'desc '.$table.';';

    // 发送多重查询
    $mysqli->multi_query($sql) or die('查询失败'.$mysqli->error);


    // 循环取出结果
    do{
        // 取出当前结果集
        $res = $mysqli->store_result();

        // 打印表格的列数和行数
        echo "<br/>表 $table 有 $res->field_count 列 和 $res->num_rows 行 <br/> ";

        // 获取表头
        echo "<table border='1'><tr>";
        while ($field = $res->fetch_field()) { 
                echo "<th>{$field->name}</th>";
        }
        echo "</tr>";

        // 打印数据
        while ($row = $res->fetch_row()) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                 echo "<th>{$value}</th>";
            }
            echo "</tr>";
        }

        echo "</table>";

        // 释放结果
        $res->free();

        // 判断是否有下一个结果集
        if(!$mysqli->more_results())
        {
            break;
        }

    }while($mysqli->next_result());//指针移到下个结果集

    $mysqli->close();//断开连接

}

mysqli_print_table('sw_user');
mysqli_print_table('sw_goods');

