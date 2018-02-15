<?php
/*配置文件
*包含连接服务器所需的配置
*方便在其他服务器上安装
*/
  $host_name="localhost";  //服务器名
  $host_user="root";  //连接服务器的用户名
  $host_pass="";  //连接服务器的密码
  $db_name="test";  //服务器上的可用数据库
  $test_user="test_user";  //用户表名
  $test_question="test_question";  //问题表名
  $test_answer="test_answer";  //答案表名
  $test_exam="test_exam";  //测试记录表名
  $mysqli=new mysqli($host_name,$db_name,$host_user,$host_pass);  //定义对象
  $mysqli->query("set names 'gb2312'");  //设置编码为中文
?>
