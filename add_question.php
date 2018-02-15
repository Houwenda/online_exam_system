<?php
/*添加题目
*选择一种题目类型
*输入题目内容
*将相关信息加入问题表和答案表
*/
  echo "<center>";
  include "check admin.php";
  echo "添加题库<p>\n";
  if(!isset($_POST["type"]))
  {
    ?>
    <table border="1">
      <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
        <tr><td colspan="2" align="center">请选择题目类型</td></tr>
        <tr>
          <td>题目类型</td>
          <td>
            <select size="1" name="type">
              <option value="1">选择题</option>
              <option value="2">判断题</option>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="submit" value="下一步">
          </td>
        </tr>
      </form>
    </table>
    <?php
  }
  else if(!isset($_POST["content"]))
  {
    ?>
    <table border="1">
      <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
        <tr>
          <td>题目类型：</td>
          <td><?php
          if($_POST["type"]==1) echo "选择题";
          else echo "判断题";
          ?>
          </td>
        </tr>
        <tr>
          <td>请输入题目内容</td>
          <td><input type="text" name="content" size="30"></td>
          <tr>
            <tr>
              <td>请输入/选择该题答案</td>
              <td>
                <?php
                  if($_POST["type"]==1)
                  {
                    for($i=0;$i<4;$i++)
                    {
                      echo ($i+1)."<input type=text name='answer[]'>\n";
                      echo "<input type=radio name='check' value=".$i."><br>\n";
                    }
                  }
                  else
                  {
                    echo "<input type=radio value=1 name='answer'>正确\n";
                    echo "<input type=radio value=2 name='answer'>错误\n<p>";
                  }
                  echo "被选中项为正确答案";
                ?>
              </td>
              <tr>

              </tr>
              <td colspan="2" align="center">
                <input type="hidden" name="type" value="<?php echo $_POST["type"]?>">
                <input type="button" value="上一步"; onclick="history.go(-1)"><input type="submit" value="下一步">
              </td>
            </tr>
          </form>
        </table>
        <?php
      }
      else {
        $type=$_POST["type"];
        $content=$_POST["content"];
        $answer=$_POST["answer"];
        include "config.php";
        if($type==2)
        {
          $sql="INSERT INTO $test_question (content,type,answer) VALUES ('$content','$type','$answer')";
          $result=$mysqli->query($sql) or die($mysqli->error);
          if($result)
          {
            echo "成功添加题库！！！";
            echo "单击<a href='admin.php'>这里</a>返回";
          }
          else {
            echo "添加题库出错";
          }
        }
        else {
            $check=$_POST["check"];
            $sql="INSERT INTO $test_question(content,type) VALUES ('$content','$type')";
            $result=$mysqli->query($sql) or die($mysqli->error);
            $question_id=$mysqli->insert_id;
            $sql2="INSERT INTO $test_answer (content,question,answer) VALUES ";
            for($i=0;$i<4;$i++)
            {
              $sql2=$sql2."(";
              $sql2=$sql2."'".$answer[$i]."'，";
              $sql2=$sql2.$question_id."，";
              if($check==$i)
              {
                $sql2=$sql2."1)";
              }
              else {
                $sql2=$sql2."0)";
              }
              if($i<3)
              {
                $sql2=$sql2."，";
              }
            }
            $result2=$mysqli->query($sql2) or die($mysqli->error);
            if($result and $result2)
            {
              echo "成功添加到题库！！！";
              echo "单击<a href='admin.php'>这里</a>返回";
            }
            else {
              echo "添加题库出错";
            }
            }
          }
  echo "</center>";
?>
