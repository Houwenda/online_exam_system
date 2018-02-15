<?php
/*用户登录
*前台供用户输入用户名、密码
*后台判断是否指定用户名且密码正确
*否则提示用户重新输入
*是则将用户登录信息写入cookie，提示用户进入首页
*/
  if(!isset($_POST["user"]))
  {
    echo "<center>";
    ?>
    <table border=1>
      <form action="login.php" method="post">
        <tr>
          <td colspan="2" align="center">用户登录</td>
        </tr>
        <tr>
          <td>输入用户名：</td>
          <td><input type="text" name="user"></td>
        </tr>
        <tr>
          <td>输入密码：</td>
          <td><input type="password" name="pass"></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input type="submit" value="登录"></td>
        </tr>
      </form>
    </table>
    <?php
  }
  else {
    include "config.php";
    $user=$_POST["user"];
    $pass=$_POST["pass"];
    $sql="SELECT COUNT(id) FROM $test_user WHERE name='$user' AND pass='$pass'";
    $result=$mysqli->query($sql);
    $num=$result->num_rows;
    if($num==0)  //判断用户密码是否正确
    {
      echo "用户名或密码错误！<p>";
      echo "单击<a href='login.php'>这里</a>重新登录";
    }
    else {
      setcookie("user",$user);
      echo "登录成功！<p>";
      echo "单击<a href='index.php'>这里</a>进入系统";
    }
  }
?>
</center>
