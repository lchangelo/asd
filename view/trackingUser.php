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
<link href="js/easyui/themes/default/easyui.css" rel="stylesheet" type="text/css" />
<link href="js/easyui/themes/icon.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/easyui/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="js/easyui/jquery.easyui.min.js" charset="utf-8"></script>
        <script>
            function onfim(){
                var ycc=$("#ycc option:selected").text();
                var mcc=$("#mcc option:selected").text();
                var msg="ȷ�Ͻ�"+ycc+"��Ա�������ڲ����ĵ���ת�ɸ�"+mcc+"�������Ϣ?";
                return confirm(msg);
            }
        </script>
</head>
    <body>
        <form  method="post" action="index.php?c=plan&f=trackUser&type=2" onsubmit="return onfim()">
        <div id="pat" class="easyui-panel" title="ת������"
            style="width:50%;height:450px;padding:10px;background:#fafafa;"
            data-options="iconCls:'icon-save',closable:true,
            collapsible:true,minimizable:true,maximizable:true" maximizable="false" 
            minimizable="false" closable="false" maximized="true" >
          <div><p>��ת�ɽ������ڴ���ĵ���</p></div>
          <div><p>ԭ����ͷ���Ա</p></div>
          <select id="ycc" class="easyui-combobox" name="ycc" style="width:200px;">
             
                <option value="8001">8001</option>
                <option value="8002">8002</option>
                <option value="8003">8003</option>
                <option value="8004">8004</option>
                <option value="8005">8005</option>
                <option value="8006">8006</option>
          </select>
          <div><p>ת�ɿͷ���Ա</p></div>
          <select id="mcc" class="easyui-combobox" name="mcc" style="width:200px;">

                <option value="8001">8001</option>
                <option value="8002">8002</option>
                <option value="8003">8003</option>
                <option value="8004">8004</option>
                <option value="8005">8005</option>
                <option value="8006">8006</option>
          </select>
          <p></p>
          <div>
            <input class="easyui-button" iconCls="icon-save" type="submit" value="����" />
          </div>

        </div>
        </form>
    


    </body>   
    
    
</html>

