<?php
header("Content-type:text/html;charset=utf-8");
// php 事务操作

/*
CREATE TABLE `user2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `money` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO  user2 (name,money) values ('小明',10000),('小张','100')
;
 */

$mysqli = new mysqli('localhost','root','root','test');
if ($mysqli->connect_error) {
   die('connect failuer'.$mysqli->error);
}
// 关闭自动提交
$mysqli->autocommit(false);

$sql1 = 'update user2 set money=money-100 where id=5';
$sql2 = 'update user2 set money=money+100 where id=6';

$b1 = $mysqli->query($sql1);
$b2 = $mysqli->query($sql2);

if (!$b1 || !$b2) {
    echo '失败，回滚'.$mysqli->error;
    $mysqli->rollback();
}
else
{
    echo "操作成功";
    $mysqli->commit();
}
$mysqli->close();


