<?php
/*查看历史考试记录
*判断是否已经等录
*是则遍历exam表
*/
  echo "<center>";
  echo "欢迎使用考试系统!<p>";

  if(!$_COOKIE["user"])
  {
    echo "你还没有登录！<p>";
    echo "<a href='login.php'>登录</a>&nbsp;&nbsp;&nbsp;<a href=reg.php>注册</a>";
  }
  else {
    $user=$_COOKIE["user"];
    echo "查看用户".$user."的历史考试成绩<p>";
    include "config.php";
    $sql="SELECT * FROM $test_exam WHERE name='$user'";//遍历指定用户考试记录
    $reuslt=$mysqli->query($sql);
    $num=$result->num_rows;
    if($num==0)
    {
      echo "还没有用户的历史考试记录";
    }
    else {
      echo "共有".$num."条历史考试记录";
      echo "<p>";
      echo "<table border='1'>";
      echo "<tr><td>序 号</td><td>用 户</td><td>成 绩</td><td>考 试 日 期</td></tr>";
      while($row=$result->fetch_array())
      {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["score"]."</td>";
        echo "<td>".$row["date"]."</td>";
        echo "</tr>";
      }
      echo "</table>";
    }
    echo "<a href=index.php>返回</a>";
    echo "</center>";
  }
  ?>
