<?php if (!defined('BASE_PATH'))    exit('Access denied!'); ?>
<?php session_start();$view = new base(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>批量退订</title>
<link href="css/thickbox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/thickbox3.1.js"></script>
<script type="text/javascript" src="js/customer.js"></script>
<script type="text/javascript" src="uploadify-v3.1/jquery.min.js"></script>
<script type="text/javascript" src="uploadify-v3.1/jquery.uploadify-3.1.js"></script>
<?php include (BASE_PATH . 'view/public/thickbox1.php') ?>
<style>
body {background: #FFFFFF;}
#right{ width:450px; float:left; clear:right; margin:0 0 0 10px;}
#right .top{ width:450px; height:31px; text-align:left; font-size:18px; line-height:30px; font-weight:bold; padding:0 0 0 35px;}
#right .grop{ background:#FFFFFF; border:#CCCCCC 1px solid; border-top: none; text-align:left; width:100%; height:600px;}
#right .table{ border:#CCCCCC 1px solid; width:450px; margin:10px 5px 10px 5px;}
#right .tabletop{ background:#FFFFFF; width:450px; height:27px; line-height:27px;}
#right .tabletop h1{float:left; font-size:14px; padding-left:7px; border-right:#FFFFFF 1px solid;}
#right .tabletr{float:left;width:100%;height:24px;}
#right .tabletd{float:left;height:24px; font-size:12px; line-height:24px;padding-left:7px;border-right:#FFFFFF 1px solid;}
</style>
</head>
<body onmouseover="window.status='';return true " >
<form  method="post" action="index.php?c=case&f=btch_del" >
<center>
<div id="top">批量退订</div>
<div id="body">
<div class="tr">
	<div class="td">客服姓名</div>
	<div class="td"><input type="text" name="ModUser" id="ModUser" value="<?= $view->xssCheck($_SESSION['user']['nickname']) ?>" /></div>
</div>
<div style="text-align:center; border-bottom:#CCCCCC 1px solid;">业务电话,以逗号分割</div>
<div class="tr" style="text-align:center; height:auto; border-bottom:#CCCCCC 1px solid;">
    <textarea name="tel" id="tel" class="text" onblur="setReturn()"></textarea>
</div>
<div class="tr">
	<div class="td">归属地</div>
        <div class="td">
            <select  name="Dcity" id="Dcity">
                <option value="" selected="selected" >请选择</option>
                <option value="福州">福州</option>
                <option value="莆田">莆田</option>
                <option value="南平">南平</option>
                <option value="泉州">泉州</option>
                <option value="宁德">宁德</option>
                <option value="厦门">厦门</option>
                <option value="漳州">漳州</option>
                <option value="三明">三明</option>
                <option value="龙岩">龙岩</option>
            </select>
         </div>
</div>
<div class="tr">
	<div class="td">投诉方式</div>
        <div class="td">
            <select  name="type" id="type" onclick="checkCrm()">
                <option value="x" selected="selected" >请选择</option>
                <option value="CRM">CRM</option>
                <option value="ECP">ECP</option>
                <option value="海春Q">海春Q</option>
                <option value="QQ">QQ</option>
                <option value="QQ邮件">QQ邮件</option>
                <option value="电话上行">电话上行</option>
            </select>
         </div>       
</div>
<div style="text-align:center; border-bottom:#CCCCCC 1px solid;">投诉内容：请填写CRM或者ECP发送的内容</div>
<div class="tr" style="text-align:center; height:auto; border-bottom:#CCCCCC 1px solid;">
    <textarea name="content" id="content" class="text"></textarea>
</div>
<p>&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;</p>
<div style="text-align:center;">
<input type="submit" value="保存" onclick="return confirm('确认保存表单信息?')" />
   </div>
</div>
<div style="width:491px;"><img src="images/t_3.jpg" /></div>
</center>
</form>
</body>
</html>

<script>
//回复内容提供
function setReturn(){
    alert("xxxx");
    var d = new Date();
    var vYear = d.getFullYear();
    var vMon = d.getMonth() + 1;
    var vDay = d.getDate();
    var ymd=vYear+"年"+vMon+"月"+vDay+"日";
    var ttel=$("#tel").val();
    var mon="";
   if(ttel!==""){
        if(vDay>=28){
            mon="次";
        }
        else{
            mon="本";
        }
        $("#content").text(ttel+",以上用户已于"+ymd+"做退订处理，"+mon+"月不在收费");
       
   }
    
  

	 
}

</script>
    

