<?php 
header('Content-type: text/html;charset=GBK');
$filepath=$_GET["url"];
$path="record\\".$filepath.".wav";
//echo $path;
echo "<embed src=\"".$path."\" width=\"100%\" height=\"45\" autostart=\"true\" loop=\"true\"></embed>";

//echo "<br/><a href=".$path.">����</a><p\>";

//echo "   ���һ������ء�ѡ��Ŀ�����Ϊ���������أ�";
//echo "<br/><a href='wavepad.exe'>����</a>   GSM¼���ļ�������";

 ?>