<?php if (!defined('BASE_PATH')) exit('Access denied!');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>快乐学习客服登录系统</title>
<link href="css/index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/changeImg.js"></script>
<script language="javascript">
	function yanZheng(){
	   var userId=$("#userId").val();
       var password=$("#pass1").val();
		if(userId==null||userId==''||userId==' '){
			alert("请输入您的用户名");
            return false;
		} 
        if(password==null||password==''||password==' '){
			alert("请输入您的密码");
            return false;
		}
		return true;
	}
</script>
</head>
<body onMouseOver="window.status='';return true ">
<div id="head">
<div style="float:left;"><img src="images/i_logo.gif" /></div>
<div style="float:right; height:30px;">
<iframe src="http://m.weather.com.cn/m/pn7/weather.htm?id=101230101T" width="195" height="40" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" allowtransparency="true"  scrolling="no"></iframe>
</div>
</div>
<form action="index.php?c=login&f=dologin" onsubmit="return yanZheng()" method="post">
<center>
<div id="login_box">
<div class="text1">
用户名：
    <input name="userId" type="text" class="box" maxlength="20" id="userId"/>
</div>
<div class="text2">
密&nbsp;码：
    <input name="pass1" type="password" class="box" maxlength="32" id="pass1"/>
 </div>
    <div class="btn"> 
    	<input  type="image" value="" src="images/login.gif" onmouseover="change1(this)" onmouseout="change2(this)"/>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="image" value="" src="images/rest.gif" onclick="reset();return(false)" onmouseover="change3(this)" onmouseout="change4(this)"/>
  </div>
</div>
</center>
</form > 
<div id="feet">版权所有归益通信息科技有限公司　　　&copy;1997-2016<br />
　</div>
</body>
</html>
