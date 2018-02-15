<?php
/*显示所有题目
*遍历
*给出添加、查看、修改、删除题目的链接
*/
  echo "<center>";
  include "check_admin.php";
  echo "题库管理<p>";
  echo "<a href='add_question.php'>添加题库</a><p>";
  include "config.php";
  $sql="SELECT * FROM $test_question";
  $result=$mysqli->query($sql);
  $num=$result->num_rows;
  if($num==0)
  {
    echo "还没有题库记录！";
  }
  else {
    echo "共有".$num."条题库记录";
    echo "<p>";
    echo "<table border='1'>";
    echo "<tr><td>序号</td><td>题目</td><td>类型</td><td>查看</td><td>修改</td><td>删除</td></tr>";
    while($row=$result->fetch_array())  //循环显示所有记录
    {
      echo "<tr>";
      echo "<td>".$row["id"]."</td>";
      echo "<td>".$row["content"]."</td>";
      echo "<td>";
      if($row["type"]==1)
      {
        echo "选择题";
      }
      else {
        echo "判断题";
      }
      echo "</td>";
      echo "<td><a href=show_question.php?id=".$row[0].">查看</a></td>";
      echo "<td><a href=edit_question.php?id=".$row[0].">修改</a></td>";
      echo "<td><a href=del_question.php?id=".$row[0].">删除</a></td>";
      echo "</tr>";
    }
    echo "</table>";
  }
  echo "</center>";
  ?>
