<center>
<?php
/*用户注册
*前台显示表单，用户提交用户名、密码
*后台判断用户名是否存在重复，若重复则返回错误
*若无误，则加入用户表中
*/
  if(!isset($_POST["user"]))  //没有输入内容则显示表单
  {
    ?>
    <table border=1>
      <form action="reg.php" method="post">
        <tr>
          <td colspan="2" align="center">用户注册</td>
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
          <td colspan="2" align="center" ><input type="submit" value="注册"></td>
        </tr>
      </form>
    </table>
    <?php
  }
  else {
    include "config.php";
    $user=$_POST["user"];
    $pass=$_POST["pass"];
    $sql="SELECT * FROM $test user WHERE name='$user'";  //判断用户名是否重复
    $result=$mysqli->query($sql);
    $num=$result->num_rows;
    if($num>0)
    {
      echo "用户名已存在！";
      echo "单击<a href='reg.php'>这里</a>重新注册";
    }
    else  //用户名未重复
    {
      $sql="INSERT INTO $test_user (name,pass,admin) VALUES ('$user','$pass',0)";
      $result=$mysqli->query($sql) or die($mysql->error);
      if($result)
      {
        echo "注册成功！<p>";
        echo "单击<a href='login.php'>这里</a>登录系统";
      }
    }
  }
?>
</center>
