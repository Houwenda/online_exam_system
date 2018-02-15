<?php
/*检查管理员权限
*检查登录用户是否为管理员
*/
  include "config.php";
  $sql="SELECT COUNT(admin) FROM $test_user WHERE name='$_COOKIE[user]'";
  $result=$mysqli->query($sql);
  $admin=$result->fetch_row();
  if($admin[0]==0)
  {
    echo "你不是管理员，不能执行该操作！！！";
    exit("");
  }
?>
