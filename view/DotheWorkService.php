<?php if (!defined('BASE_PATH')) exit('Access denied!');
session_start();
$view=new base;
$uid=$_SESSION['user']['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>����ͷ������</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/data.js"></script>
<script type="text/javascript" src="js/sdata.js"></script>
<script type="text/javascript" src="js/thickbox_plus.js"></script>
<script type="text/javascript" src="js/animatedcollapse.js"></script>
<script type="text/javascript" src="js/jquery-1.2.2.pack.js"></script>
<script>
function check(){
    var tel=$("#tel").val();
}

function addDiv(times){
		for(i=2;i<=times;i++){
		animatedcollapse.addDiv('news0'+i, 'fade=1,speed=200,hide=1');
		}
	}
animatedcollapse.addDiv('news01', 'fade=1,speed=200,hide=0');
animatedcollapse.ontoggle=function($, divobj, state){}
animatedcollapse.init()

function hiddenDD(id,maxid){
        for(var i=1;i<=maxid;i++){
            if(i!=id){
                //alert(i);
                document.getElementById('news0'+i).style.display='none';
            }
        }
}

</script>

</head>
<body onmouseover="window.status='';return true " onclick="window.status='';return true">
<center>

<!--body star-->
<!--right-->
<div id="right1">
	<div class="top">����ͷ������</div>
	<div class="grop">
	<form action="index.php?c=plan&f=getBusinessRecord" method="post" onsubmit="return check()">
	   <div style="height:26px; line-height:26px;">
                &nbsp;&nbsp;<strong>�绰����:</strong>
                <input type="text" name="tel" id="tel" class="search"/>&nbsp;&nbsp;&nbsp;
                <input type="image" src="images/search.jpg" name="Submit" value="�ύ" />
	   </div>
	</form>
	  <!--right table-->
	  <table class="table">
	  	<tr class="tabletop">
			<th width="10%">ҵ��绰</th>
                        <th width="10%">��ϵ�绰</th>
			<th width="10%">����ʽ</th>
			<th width="10%">��ʼ��</th>
			<th width="10%">�����</th>
                        <th width="10%">Ӫ����˾</th> 
                        <th width="10%">�ظ�</th>
			<th width="5%">״̬</th>
                        <th width="6%">ҵ��</th>
                        <th width="6%">¼��</th>
                        <th width="6%">�ص�</th>
                    
		</tr>
<?php
    if($res){
        foreach($res as $key=>$val){

?>      
                <tr style="background-color:#EEEEEE; height:24px;">
                <td class="tabletr1"><?= $val['tel'] ?></td>
                <td class="tabletr1"><?= $val['phone'] ?></td>
                <td class="tabletr1"><?= $val['Dmod'] ?></td>
                <td class="tabletr1"><?= $val['DgTime'] ?></td>
                <td class="tabletr1"><?= $val['DDate'] ?></td>
                <td class="tabletr1"><?= $val['DCompany'] ?></td>
                <td class="tabletr1"><?= $CountResult[0] ?></td>
                <td class="tabletr1"><?= $val['c_state'] ?></td>
                <td class="tabletr1"><?= $val['Dstate'] ?></td>
                <td class="tabletr1"><a href="#" onclick="window.open('view/play.php?url=<?= $val['tel'] ?>','newwindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=15');">����</a></td>
                <td class="tabletr1"><a class="thickbox"  href='index.php?c=plan&f=case_detail&tel=<?= $val['tel']?>&height=450&width=550&modal=true'>�ص�</a></td>
                </tr>
<?php 
     }
}
else {

		echo '<tr style="color: red;" align="center"><td colspan=4>���κη���ͷ����񣡣�</td></tr>';
     }
    

?>
	  </table>
	  <!--right table-->
<?php 
    
    $url=$view->doURL('plan','getBusinessRecord',array('tel'=>$tel));
    include('view/public/page.php');
?>
	  </div>
</div>
<!--right-->
<!--body end-->
</center>
</body>
</html>