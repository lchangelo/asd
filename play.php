<?php 
header('Content-type: text/html;charset=GBK');
echo $_GET["url"];
echo "<embed src=\"".$_GET["url"]."\" width=\"100%\" height=\"45\" autostart=\"true\" loop=\"true\"></embed>";
echo "<br/><a href=".$_GET["url"].">����</a>";
echo "���һ������ء�ѡ��Ŀ�����Ϊ���������أ�";

 ?>