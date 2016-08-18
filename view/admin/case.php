<?php if (!defined('BASE_PATH'))    exit('Access denied!'); ?>
<?php session_start();$view = new base(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>投诉派单</title>
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
<form  method="post" action="index.php?c=case&f=add" onsubmit="return check()">
<center>
<div id="top">投诉派单</div>
<div id="body">
<div class="tr">
	<div class="td">客服姓名</div>
	<div class="td"><input type="text" name="ModUser" id="ModUser" value="<?= $view->xssCheck($_SESSION['user']['nickname']) ?>" /></div>
</div>
<div class="tr">
	<div class="td">订单号</div>
	<div class="td"><input type="text" name="case" id="case"/><br/></div>
</div>
<div class="tr">
	<div class="td">业务电话</div>
	<div class="td"><input type="text" name="tel" id="tel"  onblur="if(/[^0-9\,]/g.test(value)||/\,\B/.test(value)){tel.value='';alert('请正确输入业务号码');}" /><br/></div>
</div>
<div class="tr">
	<div class="td">联系电话</div>
	<div class="td"><input type="text"  name="phone" id="phone" /></div>
</div>
<div class="tr">
	<div class="td">工单来源</div>
	<div class="td"><input type="text"  name="Dfrom" id="Dfrom" /></div>
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
	<div class="td">处理方式</div>
        <div class="td">
            <select  name="Dmod" id="Dmod">
                <option value="" selected="selected" >请选择</option>
                <option value="业务受理单">业务受理单</option>
                <option value="咨询单">咨询单</option>
                <option value="协办单">协办单</option>
                <option value="SP投诉单">SP投诉单</option>
                <option value="SP受理单">SP受理单</option>
                <option value="督办单">督办单</option>
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
<div class="tr">
	<div class="td">结单状态</div>
        <div class="td">
            <select  name="state" id="state">
                <option value="" selected="selected" >请选择</option>
                <option value="正在操作" selected="selected">正在操作</option>
                <option value="结单">结单</option>
                <option value="无法联系">无法联系</option>
                <option value="异常">异常</option>
            </select>
         </div>       
</div>
<div class="tr">
	<div class="td">选择客服</div>
        <div class="td">
            <select  name="employer" id="employer">
                <option value="" selected="selected">请选择</option>
                <option value="8001">8001</option>
                <option value="8002">8002</option>
                <option value="8003">8003</option>
                <option value="8004">8004</option>
                <option value="8005">8005</option>
                <option value="8006">8006</option>
            </select>
         </div>
        
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
/** 显示控件 */
function showDate(){
   var is=$("#col2").attr("value");
    if($("#col2").attr("checked")==true){     
        document.getElementById('emp').style.display='';
        document.getElementById('employer').focus();
    }
    else{
        document.getElementById('emp').style.display='none';
    };	
	 
}



function  check() {
   var type=$("#type").attr("value");
   var OrderNo=$("#OrderNo").val(); 
   var tel=$("#tel").attr("value");
   var content=$("#content").attr("value");
   var contentCall=$("#contentCall").attr("value");
    if(type=="c"&&OrderNo==""){
          alert("请填写订单号");
          document.getElementById('OrderNo').focus();
          return false;
       }
     else if(tel==''||content==''){
          alert("业务电话，投诉内容，回访内容不能为空");
          return  false;
     }
}

//检查当选择CRM时，订单编号不能为空
function  checkCrm() {
   var type=$("#type").attr("value");
   var valcase=$("#case").val();
   
    if(type==="c"&&valcase===""){
          alert("请填写订单号");
          document.getElementById('case').focus();
          return false;
       }
}

</script>
    

