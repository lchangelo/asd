<?php if (!defined('BASE_PATH'))    exit('Access denied!'); ?>
<?php session_start();$view = new base(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�����˶�</title>
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
<div id="top">�����˶�</div>
<div id="body">
<div class="tr">
	<div class="td">�ͷ�����</div>
	<div class="td"><input type="text" name="ModUser" id="ModUser" value="<?= $view->xssCheck($_SESSION['user']['nickname']) ?>" /></div>
</div>
<div style="text-align:center; border-bottom:#CCCCCC 1px solid;">ҵ��绰,�Զ��ŷָ�</div>
<div class="tr" style="text-align:center; height:auto; border-bottom:#CCCCCC 1px solid;">
    <textarea name="tel" id="tel" class="text" onblur="setReturn()"></textarea>
</div>
<div class="tr">
	<div class="td">������</div>
        <div class="td">
            <select  name="Dcity" id="Dcity">
                <option value="" selected="selected" >��ѡ��</option>
                <option value="����">����</option>
                <option value="����">����</option>
                <option value="��ƽ">��ƽ</option>
                <option value="Ȫ��">Ȫ��</option>
                <option value="����">����</option>
                <option value="����">����</option>
                <option value="����">����</option>
                <option value="����">����</option>
                <option value="����">����</option>
            </select>
         </div>
</div>
<div class="tr">
	<div class="td">Ͷ�߷�ʽ</div>
        <div class="td">
            <select  name="type" id="type" onclick="checkCrm()">
                <option value="x" selected="selected" >��ѡ��</option>
                <option value="CRM">CRM</option>
                <option value="ECP">ECP</option>
                <option value="����Q">����Q</option>
                <option value="QQ">QQ</option>
                <option value="QQ�ʼ�">QQ�ʼ�</option>
                <option value="�绰����">�绰����</option>
            </select>
         </div>       
</div>
<div style="text-align:center; border-bottom:#CCCCCC 1px solid;">Ͷ�����ݣ�����дCRM����ECP���͵�����</div>
<div class="tr" style="text-align:center; height:auto; border-bottom:#CCCCCC 1px solid;">
    <textarea name="content" id="content" class="text"></textarea>
</div>
<p>&nbsp;&nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;</p>
<div style="text-align:center;">
<input type="submit" value="����" onclick="return confirm('ȷ�ϱ������Ϣ?')" />
   </div>
</div>
<div style="width:491px;"><img src="images/t_3.jpg" /></div>
</center>
</form>
</body>
</html>

<script>
//�ظ������ṩ
function setReturn(){
    alert("xxxx");
    var d = new Date();
    var vYear = d.getFullYear();
    var vMon = d.getMonth() + 1;
    var vDay = d.getDate();
    var ymd=vYear+"��"+vMon+"��"+vDay+"��";
    var ttel=$("#tel").val();
    var mon="";
   if(ttel!==""){
        if(vDay>=28){
            mon="��";
        }
        else{
            mon="��";
        }
        $("#content").text(ttel+",�����û�����"+ymd+"���˶�����"+mon+"�²����շ�");
       
   }
    
  

	 
}

</script>
    

