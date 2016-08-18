<?php if (!defined('BASE_PATH')) exit('Access denied!');
session_start();
$view=new base;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>客服处理情况表
、</title>
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
	<div class="top">业务开通情况表</div>
	<div class="grop">
	<form action="index.php?c=plan&f=getBusinessRecord" method="post" onsubmit="return check()">
	   <div style="height:36px; line-height:36px;">
          &nbsp;&nbsp;<strong>电话号码:</strong>
    	  <input type="text" name="tel" id="tel" class="search"/>&nbsp;&nbsp;&nbsp;
    	  <input type="image" src="images/search.jpg" name="Submit" value="提交" />
	   </div>
	</form>
	  <!--right table-->
	  <table class="table">
	  	<tr class="tabletop">
                        <th width="10%">业务名称</th>
			<th width="10%">业务资费</th>
			<th width="10%">开通时间</th>
			<th width="10%">收费时间</th>
                        <th width="10%">退订时间</th> 
			<th width="10%">退费时间</th>
                        <th width="10%">开通方式</th>
                <th rowspan="21">
                </th>
		</tr>
              	<tr style="background-color:#EEEEEE; height:24px;">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
          </table>
</div>
</div>
<!--right-->
<!--body end-->
</center>
</body>
</html>