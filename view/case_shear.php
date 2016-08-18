<?php if (!defined('BASE_PATH')) exit('Access denied!');
session_start();
$view=new base;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>投诉单情况表</title>
<link href="css/thickbox.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="js/easyui/themes/default/easyui.css" rel="stylesheet" type="text/css" />
<link href="js/easyui/themes/icon.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/easyui/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="js/easyui/jquery.easyui.min.js" charset="utf-8"></script>



</head>
<body onmouseover="window.status='';return true " onclick="window.status='';return true">
<center>

<!--body star-->
<!--right-->
<div id="right1">
	<form action="index.php?c=plan&f=getAuditRecord" method="post" onsubmit="">
	   <div style="height:100px; line-height:36px;">
          &nbsp;<strong>电话号码:</strong>
    	  <input type="text" name="tel" id="tel" class="search"/>&nbsp;
          &nbsp;<strong>填单日期:</strong>
          <input id="dd" name="dd" type="text" class="easyui-datebox"></input>&nbsp;
          &nbsp;<strong>订单编号:</strong>
    	  <input type="text" name="DCase" id="DCase" class="search"/>&nbsp;&nbsp;
    	  <input type="image" src="images/search.jpg" name="Submit" value="提交" />
	   </div>
	</form>
        <div id="pat" class="easyui-panel" title="待办客服处理表"
            style="width:70%;height:350px;padding:10px;background:#fafafa;"
            data-options="iconCls:'icon-save',closable:true,
            collapsible:true,minimizable:true,maximizable:true" maximizable="false" 
            minimizable="false" closable="false" maximized="true" >
           <table id="dg" class="easyui-datagrid" style="width:100%;height:300px" data-options="url:'abc.json',fitColumns:true,singleSelect:true,pagination:true">
               <thead>
                            <tr>
                                <th data-options="field:'tel',width:70,align:'center'">业务电话</th>
                                <th data-options="field:'c_type',width:70,align:'center'">投诉方式</th>
                                <th data-options="field:'employer',width:70,align:'center'">客服人员</th>
                                <th data-options="field:'Dmod',width:70,align:'center'">处理方式</th>
                                <th data-options="field:'Inputdate',width:70,align:'center'">操作日期</th>
                                <th data-options="field:'overdate',width:70,align:'center'">结单日期</th>
                                <th data-options="field:'c_state',width:70,align:'center'">状态</th>
                                <th data-options="field:'content',width:70,align:'center'" >投诉内容</th>
                                <th data-options="field:'c_return',width:70,align:'center'" >回访结果</th>
                                <th data-options="field:'rate',width:70,align:'center'" >备注</th>
                            </tr>
                </thead>
               <tbody>
                <?php
                    if($res){
                        foreach($res as $key=>$val){
                          
                ?> 
                           <tr>
                            <td><?= $val['tel'] ?></td>
                            <td><?= $val['cCallTel'] ?></td>
                            <td><?= $val['employer'] ?></td>
                            <td><?= $val['Dmod'] ?></td>
                            <td><?= $val['Inputdate'] ?></td>
                            <td><?= $val['overdate'] ?></td>
                            <td><?= $val['c_state'] ?></td>
                            <td><?= $val['content'] ?></td>
                            <td><?= $val['c_return'] ?></td>
                            <td><?= $val['rate'] ?></td> 
                           </tr>
                                  
                <?php 
                     
                 
                        }
                }
                else {

                                echo '<tr style="color: red;" align="center"><td colspan=4>无记录！！</td></tr>';
                     }


                ?>
               </tbody>
           </table>
        </div>
            
      <div id="win" class="easyui-window" title="投诉详细内容" closed="true" style="width:300px;height:300px;padding:5px;" hidden='true'>
            <p>投诉内容</p>
            <p id="conp"></p>
       </div>        
          

</div>
<!--right-->
<!--body end-->
</center>
<script>
function check(){
    var tel=$("#tel").val();
    //var dat=$("#dat").val();
    if((tel== null ||tel==' '||tel=='')){
        alert('请输入电话号码或者日期');
        return false;
    }
    return true;
}
    $('#dg').datagrid({
           onClickCell:function(index,field,value){
               if(field==="content" || field==="c_return" || field==="rate"){
                   $('#conp').html(value);
                   $('#win').window('open');
                   $('#win').center();
               }
  
           }

       });





</script>
</body>
</html>