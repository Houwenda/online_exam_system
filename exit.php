<?php
/*退出登录
*用空值重写cookie
*/
  setcookie("user");
  echo "成功退出登录<p>";
  echo "单击<a href=index.php>这里</a>返回";
?>
