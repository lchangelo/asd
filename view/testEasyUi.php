<?php if (!defined('BASE_PATH')) exit('Access denied!');
session_start();
$view=new base;
$uid=$_SESSION['user']['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>����ͷ������</title>
<link href="css/thickbox.css" rel="stylesheet" type="text/css" />
<link href="js/easyui/themes/default/easyui.css" rel="stylesheet" type="text/css" />
<link href="js/easyui/themes/icon.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/easyui/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="js/easyui/jquery.easyui.min.js" charset="utf-8"></script>

</head>
    
    <body>
       
        <div id="pat" class="easyui-panel" title="����ͷ������"
            style="width:70%;height:350px;padding:10px;background:#fafafa;"
            data-options="iconCls:'icon-save',closable:true,
            collapsible:true,minimizable:true,maximizable:true" maximizable="false" 
            minimizable="false" closable="false" maximized="true" >
            <table id="dg" class="easyui-datagrid" style="width:100%;height:300px" data-options="fitColumns:true,singleSelect:true,pagination:true">
                <thead>
                            <tr>
                                <th data-options="field:'tel',width:90,align:'center'">ҵ��绰</th>
                                <th data-options="field:'phone',width:70,align:'center'">��ϵ�绰</th>
                                <th data-options="field:'Dmod',width:70,align:'center'">����ʽ</th>
                                <th data-options="field:'DgTime',width:70,align:'center'">��ʼ��</th>
                                <th data-options="field:'DDate',width:70,align:'center'">�����</th>
                                <th data-options="field:'DCompany',width:70,align:'center'">Ӫ����˾</th>
                                <th data-options="field:'CountResult',width:70,align:'center'">�ظ�</th>
                                <th data-options="field:'c_state',width:70,align:'center'">״̬</th>
                                <th data-options="field:'Dstate',width:70,align:'center'">ҵ��</th>
                                <th data-options="field:'play',width:70,align:'center'">¼��</th>
                                <th data-options="field:'case_detail',width:70,align:'center'">�ص�</th>
                            </tr>
                </thead>
                <tbody>
                <?php
                    if($res){
                        $i=0;
                        foreach($res as $key=>$val){
                          
                ?>   
                        <tr>
                            <td><?= $val['tel'] ?></td>
                            <td><?= $val['phone'] ?></td>
                            <td><?= $val['Dmod'] ?></td>
                            <td><?= $val['DgTime'] ?></td>
                            <td><?= $val['DDate'] ?></td>
                            <td><?= $val['DCompany'] ?></td>
                            <td><?= $CountResult[$i]-1 ?></td>
                            <td><?= $val['c_state'] ?></td>
                            <td><?= $val['Dstate'] ?></td>
                            <td><a href="#" onclick="window.open('view/play.php?url=<?= $val['tel'] ?>','newwindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=15');">����</a></td>
                            <td><a class="thickbox"  href='index.php?c=plan&f=case_detail&c_id=<?= $val['c_id']?>&Dgtime=<?=$val['DgTime']?>&height=450&width=550&modal=true'>�ص�</a></td>
                        </tr>
                  
                <?php 
                     
                    $i++;
                        }
                }
                else {

                                echo '<tr style="color: red;" align="center"><td colspan=4>���κη���ͷ����񣡣�</td></tr>';
                     }


                ?>
                </tbody>
            </table>
        </div>

        
    </body>
    <script>
       $('#dg').datagrid({
           onClickCell:function(index,field,value){
               if(field==="CountResult"){
                   
                   
                   
                   
                   
               }
               
               
               
              
               
           }
           
           
           
           
       });


        
        
    </script>
    
</html>