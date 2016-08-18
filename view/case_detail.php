<?php if (!defined('BASE_PATH')) exit('Access denied!'); ?>
<?php session_start();$view = new base();date_default_timezone_set('PRC'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>回单</title>
<link href="css/thickbox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/thickbox3.1.js"></script>
<script type="text/javascript" src="js/customer.js"></script>
<script type="text/javascript" src="uploadify-v3.1/jquery.min.js"></script>
<script type="text/javascript" src="uploadify-v3.1/jquery.uploadify-3.1.js"></script>
<?php include(BASE_PATH.'view/public/thickbox1.php') ?>
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
<body onMouseOver="window.status='';return true " >
<form  method="post" action="index.php?c=case&f=upd&c_id=<?= $result['c_id'] ?>&tel=<?= $result['tel'] ?>" >
<center>
<div id="top">回访详细内容</div>
<div id="body">
<div class="tr">
	<div class="td">业务电话</div>
	<div class="td" id="tel" name="tel"><?= $result['tel'] ?></div>
</div>
<div class="tr">
	<div class="td">联系电话</div>
	<div class="td"><?= $result['phone'] ?></div>
</div>
<div class="tr" >
	<div class="td">归属地</div>
	<div class="td"><?= $result['Dcity'] ?></div>
</div>
<div class="tr" >
	<div class="td">处理方式</div>
	<div class="td" id="Dmod"><?= $result['Dmod'] ?></div>
</div>
<div class="tr" >
	<div class="td">投诉方式</div>
	<div class="td"><?= $result['c_type'] ?></div>
</div>
<div style="text-align:center; border-bottom:#CCCCCC 1px solid;">投诉内容</div>
<div class="tr" style="text-align:center; height:auto; border-bottom:#CCCCCC 1px solid;">
    <textarea  class="text" readonly="true"><?= $result['content'] ?></textarea>
</div>

<?php
    $txt="";
    $ymd=date("Y")."年".date("m")."月".date("d")."日";
    $gh=$_SESSION['user']['id'];
    $dg=date("Y-m-d",strtotime($result['DgTime']));
    $mon="";//判定本月次月
    if(date("m")<28){
       $mon="本月"; 
    }
    else{
       $mon="次月";
    }
    switch ($result['Dmod'])
    {
        case '业务受理单': $txt=$result['tel']."此用户于$dg.经用户同意电话营销开通20元/月翼家私人教师业务，于$ymd.已退订，$mon起不下账。工号$gh";
        
    }
            
?>
<div style="text-align:center; border-bottom:#CCCCCC 1px solid;">回访内容</div>
<div class="tr" style="text-align:center; height:auto; border-bottom:#CCCCCC 1px solid;">
    <textarea  class="text" id="contentCall" name="contentCall"><?= $txt ?></textarea>
</div>
<div class="tr" style="text-align:center; border-bottom:#CCCCCC 1px solid;">承诺用户</div>
<div  style="text-align:center; border-bottom:#CCCCCC 1px solid;">
    <input type="checkbox" id="col1" name="back[]" value="1" />退订业务
    <input type="checkbox" id="col2" name="back[]" value="2" onclick="showDate()"/>业务退费
</div>
<div class="tr" id="emp" style="display: none;">
    <div class="td" style="text-align:right;">退费金额</div>
	<div class="td">
       <input type="text" id="isMoney" name="isMoney" onblur="if(/[^0-9]/g.test(value)||/\,\B/.test(value)||employer.value==''){employer.value='';alert('只需输入金额');employer.focus()}" />元

    </div>
</div>
<div style="text-align:center; border-bottom:#CCCCCC 1px solid;">备注</div>
<div class="tr" style="text-align:center; height:auto; border-bottom:#CCCCCC 1px solid;">
    <textarea  class="text" id="rate" name="rate"></textarea>
</div>
<div class="tr">
	<div class="td">操作人</div>
	<div class="td" id="employer" name="employer"><?= $_SESSION['user']['id'] ?></div>
</div>
<div class="tr">
	<div class="td">结单状态</div>
        <div class="td">
            <select  name="state" id="state">
                <option value="" selected="selected" >请选择</option>
                <option value="正在操作">正在操作</option>
                <option value="结单">结单</option>
                <option value="无法联系">无法联系</option>
                <option value="异常">异常</option>
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

function check(){
    
}

</script>
</html>