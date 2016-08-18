<?php 
header('Content-type: text/html;charset=GBK');
$filepath=$_GET["url"];
$path="record\\".$filepath.".wav";
//echo $path;
echo "<embed src=\"".$path."\" width=\"100%\" height=\"45\" autostart=\"true\" loop=\"true\"></embed>";

//echo "<br/><a href=".$path.">下载</a><p\>";

//echo "   请右击“下载”选择“目标另存为”进行下载！";
//echo "<br/><a href='wavepad.exe'>下载</a>   GSM录音文件播放器";

 ?>