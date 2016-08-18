<?php 
header('Content-type: text/html;charset=GBK');
echo $_GET["url"];
echo "<embed src=\"".$_GET["url"]."\" width=\"100%\" height=\"45\" autostart=\"true\" loop=\"true\"></embed>";
echo "<br/><a href=".$_GET["url"].">下载</a>";
echo "请右击“下载”选择“目标另存为”进行下载！";

 ?>