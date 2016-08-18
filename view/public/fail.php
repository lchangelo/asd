<?php if (!defined('BASE_PATH')) exit('Access denied!');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>快乐学习呼叫中心登录系统</title>
<link href="css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body { background: url(images/404.jpg) #eaedf2 no-repeat center top; font-family:宋体,Tahoma,Verdana,Segoe,sans-serif;} 
-->
</style>
<script>
function go_login(){
    if (top.location !== self.location) {
        setTimeout("top.location='index.php'",3000);//跳出框架，并回到首页
    }
    else{
        setTimeout("window.location.href='index.php'",3000);
    }
}
</script>
</head>
<body onload="go_login()">
<div id="head">
<div style="float:left;"><img src="images/i_logo.gif" /></div>
<div style="float:right; height:30px;"><iframe src="http://m.weather.com.cn/m/pn7/weather.htm?id=101010100T " width="195" height="40" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" allowtransparency="true"  scrolling="no"></iframe></div>
</div>
<center>
<div style="height:60px; width:688px; margin:460px 0 80px 0; padding:0px 0 0 0; text-align:left">
  <p>此问题可能是由下列各种问题导致的: </p>
    <ul>
  	<li id="errorExpl1" style="color: red"><?php echo htmlentities($ch,ENT_NOQUOTES,GB2312); ?></li>
    <li id="errorExpl2">Internet 连接已丢失。</li>
    <li id="errorExpl3">该网站暂时不可用。</li>
    <li id="errorExpl4">无法连接到域名服务器(DNS)。</li>
    </ul>
</div>
</center>
<div id="feet">版权所有归益信通信息科技有限公司&copy;1997-2016<br />

</body>
</html>
