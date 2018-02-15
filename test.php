<?php
/*考试页面
*从题库随机选择指定数据的单选题与判断题，供用户答题
*提交答案后，后台判断正误，计算得分
*将考试结果存入exam表中
*/
  echo "<center>";
  echo "欢迎使用考试系统！<p>";

  if(!isset($_COOKIE["user"]) or $_COOKIE["user"]=="")  //如果没有登录
  {
    echo "你还没有登录！<p>";
    echo "<a href='login.php'>登录</a>&nbsp;&nbsp;&nbsp;<a href='reg.php'>注册</a>";
  }
  else {
    if(!isset($_POST["c"]))  //如果没有提交内容显示题目
    {
      echo "欢迎您：".$_COOKIE["user"];
      echo "现在开始考试！<p>\n";
      echo "</center>";
      include "config.php";
      echo "<form action=".$_SERVER["PHP_SELF"]."method='post'>";
      echo "一、选择题（每题1分）<p>\n";
      $sql="SELECT * FROM $test_question WHERE type=1 order by rand() LIMIT 5";
      $result=$mysqli->query($sql);
      $i=1;
      while($row=$result->fetch_array())
      {
        echo $i.'、';
        echo $row["content"];
        echo "<br>\n";
        $s="SELECT * FROM $test_answer WHERE question='$row[id]'";
        $r=$mysqli->query($s);
        $head=65;
        while($row2=$r->fetch_array())
        {
          echo chr($head).".";
          echo $row2["content"];
          echo "<input type='radio' name=c[".($i-1)."] value=".$row2["id"].">\n";
          echo "<br>\n";
          $head+=1;
        }
        $i+=1;
        echo "<p>\n";
      }
      echo "二、判断题（每题1分）<p>\n";
      $sql="SELECT * FROM $test_question WHERER type=2 order by rand() LIMIT 5";
      $result=$mysqli->query($sql);
      $i=1;
      while($row=$result->fetch_array())
      {
        echo $i.'、';
        echo $row["content"];
        echo "<br>\n";
        echo "正确<input type='radio' name=d[".($i-1)."] value='1'>\n";
        echo "错误<input type='radio' name=d[".($i-1)."] value='0'>\n";
        echo "<input type='hidden' name=s[] value=".$row["id"].">\n";
        $i+=1;
        echo "<p>\n";
      }
      echo "<p><input type='submit' value='完成考试！'";
      echo "</form>";
    }
    else {  //如果提交内容则进行操作
      $c=$_POST["c"];
      $d=$_POST["d"];
      $s=$_POST["s"];
      $score=0;
      $num1=count($c);
      $num2=count($d);
      include "config.php";
      for($i=0;$i<$num1;$i++)
      {
        $sql="SELECT answer FROM $test_answer WHERE id='$c[$i]'";
        $result=$mysqli->query($sql);
        $a=$result->fetch_row();
        if($a[0]==1) $score+=1;
      }
      for($i=0;$i<$num2;$i++)
      {
        $sql="SELECT id FROM $test_question WHERE id='$s[$i]' AND answer='$d[$i]'";
        $result=$mysqli->query($sql);
        $num=$result->num_rows;
        if($num>0) $score+=1;
      }
      $date=date('Y-m-d H:i:s');
      echo "你的得分为：".$score;
      $sql="INSERT INTO $test_exam (name,score,date) VALUES ('$_COOKIE[user]','$score','$date')";
      $result=$mysqli->query($sql);
      if($result)
      {
        echo "<p>已经将此次成绩入库！<p>";
        echo "单击<a href='index.php'>这里</a>返回";
      }
      else {
        echo "<p>成绩入库错误！！！<p>";
        echo "单击<a href='index.php'>这里</a>返回";
      }
    }
  }
  ?>
