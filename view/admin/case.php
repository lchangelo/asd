<?php if (!defined('BASE_PATH'))    exit('Access denied!'); ?>
<?php session_start();$view = new base(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Ͷ���ɵ�</title>
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
<div id="top">Ͷ���ɵ�</div>
<div id="body">
<div class="tr">
	<div class="td">�ͷ�����</div>
	<div class="td"><input type="text" name="ModUser" id="ModUser" value="<?= $view->xssCheck($_SESSION['user']['nickname']) ?>" /></div>
</div>
<div class="tr">
	<div class="td">������</div>
	<div class="td"><input type="text" name="case" id="case"/><br/></div>
</div>
<div class="tr">
	<div class="td">ҵ��绰</div>
	<div class="td"><input type="text" name="tel" id="tel"  onblur="if(/[^0-9\,]/g.test(value)||/\,\B/.test(value)){tel.value='';alert('����ȷ����ҵ�����');}" /><br/></div>
</div>
<div class="tr">
	<div class="td">��ϵ�绰</div>
	<div class="td"><input type="text"  name="phone" id="phone" /></div>
</div>
<div class="tr">
	<div class="td">������Դ</div>
	<div class="td"><input type="text"  name="Dfrom" id="Dfrom" /></div>
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
	<div class="td">����ʽ</div>
        <div class="td">
            <select  name="Dmod" id="Dmod">
                <option value="" selected="selected" >��ѡ��</option>
                <option value="ҵ������">ҵ������</option>
                <option value="��ѯ��">��ѯ��</option>
                <option value="Э�쵥">Э�쵥</option>
                <option value="SPͶ�ߵ�">SPͶ�ߵ�</option>
                <option value="SP����">SP����</option>
                <option value="���쵥">���쵥</option>
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
<div class="tr">
	<div class="td">�ᵥ״̬</div>
        <div class="td">
            <select  name="state" id="state">
                <option value="" selected="selected" >��ѡ��</option>
                <option value="���ڲ���" selected="selected">���ڲ���</option>
                <option value="�ᵥ">�ᵥ</option>
                <option value="�޷���ϵ">�޷���ϵ</option>
                <option value="�쳣">�쳣</option>
            </select>
         </div>       
</div>
<div class="tr">
	<div class="td">ѡ��ͷ�</div>
        <div class="td">
            <select  name="employer" id="employer">
                <option value="" selected="selected">��ѡ��</option>
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
<input type="submit" value="����" onclick="return confirm('ȷ�ϱ������Ϣ?')" />
   </div>
</div>
<div style="width:491px;"><img src="images/t_3.jpg" /></div>
</center>
</form>
</body>
</html>

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



function  check() {
   var type=$("#type").attr("value");
   var OrderNo=$("#OrderNo").val(); 
   var tel=$("#tel").attr("value");
   var content=$("#content").attr("value");
   var contentCall=$("#contentCall").attr("value");
    if(type=="c"&&OrderNo==""){
          alert("����д������");
          document.getElementById('OrderNo').focus();
          return false;
       }
     else if(tel==''||content==''){
          alert("ҵ��绰��Ͷ�����ݣ��ط����ݲ���Ϊ��");
          return  false;
     }
}

//��鵱ѡ��CRMʱ��������Ų���Ϊ��
function  checkCrm() {
   var type=$("#type").attr("value");
   var valcase=$("#case").val();
   
    if(type==="c"&&valcase===""){
          alert("����д������");
          document.getElementById('case').focus();
          return false;
       }
}

</script>
    

