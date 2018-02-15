<?php
  echo "<center";
  echo "欢迎使用考试系统！<p>";
  if(!isset($_COOKIE["user"]) or $_COOKIE["user"]=="")  //如果没有登录
  {
    echo "你还没有登录！<p>";
    ehco "<a href='login.php'>登录</a>&nbsp&nbsp&nbsp;<a href='reg.php'>注册</a>";
  }
  else {
    echo "欢迎您：".$_COOKIE["user"];
    echo "<p>";
    include "config.php";
    $sql="SELECT admin FROM test_uer WHERE name='$_COOKIE[user]'";
    $result=$mysqli->query($sql);
    $admin=$result->fetch_array();
    if($admin[0]==0)
    {
      echo "你是普通用户，点击<a href='test.php'>这里</a>开始考试！<p>";
      echo "点击<a href='exam.php'这里</a>查看历史测试成绩";
    }
    else {  //如果是管理员
      echo "你是管理员，点击<a href='admin.php'这里</a>管理题库<p>";
    }
    echo "<p>点击<a href='edit_pass.php'>这里</a>修改密码";
    echo "<p>点击<a href='exit.php'>这里</a>退出登录";
  }
  ?>
