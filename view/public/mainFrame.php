<?php if (!defined('BASE_PATH')) exit('Access denied!');
session_start();
$view=new base();
//div��ʽ
function div($name,$url){
	echo '<div class=\'butn\' onMouseOver="this.style.backgroundColor=\'#F4F9FD\'"
	 onmouseout="this.style.backgroundColor=\'\'">
	<img src=\'images/left_3.gif\' />
	&nbsp;&nbsp;<a href=\''.$url.'\' target=\'content\'>'.$name.'</a></div>';	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>��ҳ</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/animatedcollapse.js"></script>
<script type="text/javascript" src="js/jquery-1.2.2.pack.js"></script>
<script type="text/javascript" src="js/data.js"></script>
<script type="text/javascript" src="js/sdata.js"></script>
<script type="text/JavaScript">
<!--
function showsubmenu(sid){
	for(i=0;i<=2;i++)
	{
		whichEl = document.getElementById('submenu'+i);
	    if (i==sid){
	        whichEl.style.display='block';
	    }
	    else{
	    	whichEl.style.display='none';
		    }
    }
}
function closemenu()
{
	for(i=1;i<=2;i++)
	{
		whichEl = document.getElementById('submenu'+i);
		whichEl.style.display='none';
	}
}
-->
</script>
<style>
a{text-decoration: none;}
</style>
</head>
<body onmouseover="window.status='';return true" >
<center>
<!--top star-->
<div id="head">
<div style="width:1000px;">
<div class="logo"><img src="images/logo.gif" /></div>
<div class="admin">
<iframe src="http://m.weather.com.cn/m/pn7/weather.htm?id=101230101T " width="170" height="18" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" allowtransparency="true"  scrolling="no"></iframe>&nbsp;&nbsp;
<a href="index.php?f=logout" onclick="return confirm('��ȷ���˳���?')" ><img src="images/exit.png" width="15" height="15" />&nbsp;��ȫ�˳�</a><br />
<font color="#000000"><script>CalConv();</script>
</font>&nbsp;&nbsp;<img src="images/admin.png" width="15" height="15" />&nbsp;<?= $view->xssCheck($_SESSION['user']['name']) ?>&nbsp;&nbsp;&nbsp;&nbsp;�汾 V1.0</div>
</div>
</div>
<!--top end-->

<!--body star-->
<div style="width:1005px; margin:10px 0 0 0;" >
<!--left-->
<div id="left">
<img src="images/left_1.gif" />

<div class="mune"><img src="images/left_a_1.gif"/>
<div id="submenu0">
<div class="butn">�û�ID:<?= $view->xssCheck($_SESSION['user']['id']) ?></div>
<div class="butn">�û���:<?= $view->xssCheck($_SESSION['user']['nickname'])?></div>
</div>
</div>

<div class="mune" style="display:<?= ($_SESSION['user']['group']<'1')?'none':''; ?>" >
<img src="images/left_a_2.gif"/>
<div id="submenu1">
<?php
$uid=$_SESSION['user']['id'];
$dd=date('Y-m-d');
div('�ҵ�����',"index.php?c=plan&f=showTest&uid=$uid");
div('ҵ��ͨ���','index.php?c=plan&f=showView&v=business_shear');
div('��ѯͶ�ߵ�',"index.php?c=plan&f=getAuditRecord&dd=$dd");
div('�����˶�','index.php?c=case&f=case_beath');
if($_SESSION['user']['group']>'1'){
    div('����Ͷ�ߵ�','index.php?c=case&f=case_view');
    div('ת������','index.php?c=plan&f=trackUser&type=1');
}
?>
</div>
</div>
<!--
<div class="mune"><img src="images/left_c_1.gif" />
<div id="submenu2">
</div>
</div>
-->
<div><img src="images/left_4.gif" /></div>
</div>
<!--left-->
<!--right-->
	<!-- ��߷�һ����ܣ����������������ҳֱ����ʾ��������� -->
	<div id="right" style="height: 100%;">
	<iframe src="index.php?c=plan&f=showTest&uid=<?=$_SESSION['user']['id'] ?>" id="content" name="content" width="100%"
    onload="TuneHeight('content','content')" marginwidth="0" marginheight="0" 
    frameborder="0" scrolling="no" ></iframe>
    </div>
	<script language="javascript" type="text/javascript">
    function TuneHeight(fm_name,fm_id){  
        var frm=document.getElementById(fm_id);  
        var subWeb=document.frames?document.frames[fm_name].document:frm.contentDocument;  
        if(frm != null && subWeb != null){
            frm.style.height = subWeb.documentElement.scrollHeight+100+"px";
        }  
    }  
    </script>	
<!--right-->
</div>
<!--body end-->
<div id="feet">
<div style="width:1000px; text-align:center;">
��Ȩ���й�����ͨ��Ϣ�Ƽ����޹�˾����&copy;1997-2010<br />
</div>
</div>
</center>
</body>
</html>