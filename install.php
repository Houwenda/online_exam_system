<center>
<?php
/*安装文件
*在目标MySQL服务器上创建所需的4个表
*根据用户输入创建默认系统管理员
*/
  if(!isset($_POST["user"]))  //如果没有输入内容，显示表单
  {
    ?>
    <table border=1>
      <form action="install.php" method="post">
        <tr>
          <td colspan="2" align="center">输入管理员信息</td>
        </tr>
        <tr>
          <td>输入管理员名称： </td>
          <td><input type="text" name="user"></td>
        </tr>
        <tr>
          <td>输入管理员密码： </td>
          <td><input type="password" name="pass"></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input type="submit" value="开始安装"></td>
        </tr>
      </form>
    </table>
    <?php
  }
  else {
    include "config.php";
//创建用户表
    $sql1="CREAT TABLE $test_user(
      'id'  int(6)  NOT NULL AUTO INCREMENT PRIMARY KEY,
      'name' varchar(12)  NOT NULL DEFAULT '',
      'pass'  varchar(12) NOT NULL DEFAULT '',
      'admin' int(1) NOT NULL DEFAULT 0
      )ENGINE=InnoDB  DEFAULT CHARSET=gb2312";
    $step1=$mysqli->query($sql1) or die($mysqli->error);
//创建问题表
    $sql2="CREAT TABLE $test_question(
      'id'  int(6)  NOT NULL AUTO INCREMENT PRIMARY KEY,
      'content' varchar(200)  NOT NULL DEFAULT '',
      'type' int(1) NOT NULL DEFAULT 0,
      'answer'  int(1)  NOT NULL DEFAULT 0
      )ENGINE=InnoDB  DEFAULT CHARSET=gb2312";
    $step2=$mysqli->query($sql2) or die($mysqli->error);
//创建答案表
    $sql3="CREAT TABLE $test_answer(
      'id'  int(6)  NOT NULL AUTO INCREMENT PRIMARY KEY,
      'content' varchar(200)  NOT NULL DEFAULT '',
      'question' int(5) NOT NULL DEFAULT 0,
      'answer'  int(1)  NOT NULL DEFAULT 0
      )ENGINE=InnoDB  DEFAULT CHARSET=gb2312";
    $step3=$mysqli->query($sql3) or die($mysqli->error);
//创建测试记录表
    $sql4="CREAT TABLE $test_exam(
      'id'  int(6)  NOT NULL AUTO INCREMENT PRIMARY KEY,
      'name' varchar(12)  NOT NULL DEFAULT '',
      'score' int(5) NOT NULL DEFAULT 0,
      'date'  varchar(20)  NOT NULL DEFAULT ''
      )ENGINE=InnoDB  DEFAULT CHARSET=gb2312";
    $step4=$mysqli->query($sql4) or die($mysqli->error);
//创建管理员
    $user=$_POST["user"];
    $pass=$_POST["pass"];
    $sql5="INSERT INTO $test_user (name,pass,admin) VALUES ('$user','$pass',1)";
    $step5=$mysqli->query($sql5) or die($mysqli->error);
//安装成功
    if($step1 and $step2 and $step3 and $step4 and $step5)
    {
      echo "安装成功<p>";
      echo "管理员名称为：$user";
      echo "单击<a href='index.php'>这里</a>进入系统";
    }
  }
 ?>
