<?php if (!defined('BASE_PATH')) exit('Access denied!');
session_start();
$view=new base;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�û����������ѯ</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />



</head>
<body onmouseover="window.status='';return true " onclick="window.status='';return true">
<center>

<!--body star-->
<!--right-->
<div id="right1">
	<div class="top">�û����������ѯ</div>
	<div class="grop">
	<form action="index.php?c=plan&f=getBusinessRecord" method="post" >
	   <div style="height:36px; line-height:36px;">
          &nbsp;&nbsp;<strong>�绰����:</strong>
    	  <input type="text" name="tel" id="tel" class="search"/>&nbsp;&nbsp;&nbsp;
    	  <input type="image" src="images/search.jpg" name="Submit" value="�ύ" />
	   </div>
	</form>
	  <!--right table-->
	  <table class="table">
	  	<tr class="tabletop">
                        <th width="10%">ҵ��绰</th>
			<th width="10%">������</th>
                        <th width="10%">��ͨ����</th> 
			<th width="10%">����շ�</th>
                        <th width="10%">����ҵ��</th>
                        <th width="10%">����״̬</th>
                        <th width="10%">Ӫ����˾</th>
                        <th width="10%">Ӫ��ʱ��</th>
			<th width="5%">�Ƿ�Ͷ��</th>
			<th width="10%">�˷�ʱ��</th>
                        <th width="5%">�˷ѽ��</th>
                        <th rowspan="21"></th>
		</tr>
                <?php

                if($res){

                
                    foreach ($res as $key => $value) {
                        
                        if($CountResult['con']>0){
                            $url="<a href='index.php?c=plan&f=getAuditRecord&tel=".$value['tel']."'>".$CountResult['con']."</a>";
                        }
                        else{
                            $url="0";
                        }
                        
                          
                ?>   
                        <tr>
                            <td><?= $value['tel'] ?></td>
                            <td><?= $value['Dcity'] ?></td>
                            <td><?= $value['DgTime'] ?></td>
                            <td><?= $value['DDate'] ?></td>
                            <td><?= $value['Type'] ?></td>
                            <td><?= $value['Dstate'] ?></td>
                            <td><?= $value['DCompany'] ?></td>
                            <td><?= $value['PlayTime'] ?></td>
                            <td><?= $url ?></td>
                            <td><?= $value['c_date'] ?></td>
                            <td><?= $value['isMoney'] ?></td>
                        </tr>
                  
                <?php 
                     
                    
                        
                }
                }
                else {

                                echo '<tr style="color: red;" align="center"><td colspan=4>���κμ�¼����</td></tr>';
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