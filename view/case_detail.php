<?php if (!defined('BASE_PATH')) exit('Access denied!'); ?>
<?php session_start();$view = new base();date_default_timezone_set('PRC'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ص�</title>
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
<div id="top">�ط���ϸ����</div>
<div id="body">
<div class="tr">
	<div class="td">ҵ��绰</div>
	<div class="td" id="tel" name="tel"><?= $result['tel'] ?></div>
</div>
<div class="tr">
	<div class="td">��ϵ�绰</div>
	<div class="td"><?= $result['phone'] ?></div>
</div>
<div class="tr" >
	<div class="td">������</div>
	<div class="td"><?= $result['Dcity'] ?></div>
</div>
<div class="tr" >
	<div class="td">����ʽ</div>
	<div class="td" id="Dmod"><?= $result['Dmod'] ?></div>
</div>
<div class="tr" >
	<div class="td">Ͷ�߷�ʽ</div>
	<div class="td"><?= $result['c_type'] ?></div>
</div>
<div style="text-align:center; border-bottom:#CCCCCC 1px solid;">Ͷ������</div>
<div class="tr" style="text-align:center; height:auto; border-bottom:#CCCCCC 1px solid;">
    <textarea  class="text" readonly="true"><?= $result['content'] ?></textarea>
</div>

<?php
    $txt="";
    $ymd=date("Y")."��".date("m")."��".date("d")."��";
    $gh=$_SESSION['user']['id'];
    $dg=date("Y-m-d",strtotime($result['DgTime']));
    $mon="";//�ж����´���
    if(date("m")<28){
       $mon="����"; 
    }
    else{
       $mon="����";
    }
    switch ($result['Dmod'])
    {
        case 'ҵ������': $txt=$result['tel']."���û���$dg.���û�ͬ��绰Ӫ����ͨ20Ԫ/�����˽�˽�ʦҵ����$ymd.���˶���$mon�����ˡ�����$gh";
        
    }
            
?>
<div style="text-align:center; border-bottom:#CCCCCC 1px solid;">�ط�����</div>
<div class="tr" style="text-align:center; height:auto; border-bottom:#CCCCCC 1px solid;">
    <textarea  class="text" id="contentCall" name="contentCall"><?= $txt ?></textarea>
</div>
<div class="tr" style="text-align:center; border-bottom:#CCCCCC 1px solid;">��ŵ�û�</div>
<div  style="text-align:center; border-bottom:#CCCCCC 1px solid;">
    <input type="checkbox" id="col1" name="back[]" value="1" />�˶�ҵ��
    <input type="checkbox" id="col2" name="back[]" value="2" onclick="showDate()"/>ҵ���˷�
</div>
<div class="tr" id="emp" style="display: none;">
    <div class="td" style="text-align:right;">�˷ѽ��</div>
	<div class="td">
       <input type="text" id="isMoney" name="isMoney" onblur="if(/[^0-9]/g.test(value)||/\,\B/.test(value)||employer.value==''){employer.value='';alert('ֻ��������');employer.focus()}" />Ԫ

    </div>
</div>
<div style="text-align:center; border-bottom:#CCCCCC 1px solid;">��ע</div>
<div class="tr" style="text-align:center; height:auto; border-bottom:#CCCCCC 1px solid;">
    <textarea  class="text" id="rate" name="rate"></textarea>
</div>
<div class="tr">
	<div class="td">������</div>
	<div class="td" id="employer" name="employer"><?= $_SESSION['user']['id'] ?></div>
</div>
<div class="tr">
	<div class="td">�ᵥ״̬</div>
        <div class="td">
            <select  name="state" id="state">
                <option value="" selected="selected" >��ѡ��</option>
                <option value="���ڲ���">���ڲ���</option>
                <option value="�ᵥ">�ᵥ</option>
                <option value="�޷���ϵ">�޷���ϵ</option>
                <option value="�쳣">�쳣</option>
            </select>
         </div>       
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
<script>
/** ��ʾ�ؼ� */
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