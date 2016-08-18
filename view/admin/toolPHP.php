
<td><a class="thickbox"  href='index.php?c=plan&f=case_detail&c_id=<?= $val['c_id']?>&Dgtime=<?=$val['DgTime']?>&height=450&width=550&modal=true'>回单</a></td>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getHistory(){
    var tel=$("#tel").val();
    if(tel==null||tel.replace(/^\s\s*/,'').replace(/\s\s*$/,'')==''){
        alert('请填写业务电话');
        return false;
    }
    $.ajax({
        url: 'index.php?c=case&f=getHistory&tel='+tel,   
        type: 'post',      
        async: false,   
        success: function(msg){
            $("#right").html(msg);
        }
    });
    $("#right").slideToggle();
}

/***
图片上传  2012年8月13日 朱建?]
change 显示隐藏控件
uploadify 图片上传
OrderNo
***/ 
function change(){   
    var OrderNo=$("#OrderNo").val();
    if(OrderNo=="")
    {
       document.getElementById('fileupload').style.display='none';  
              }
      else  {
         document.getElementById('fileupload').style.display='';  
        }
                
    $('#myFileId').uploadify(
	{
	    'swf'  :  'view/admin/uploadify-v3.1/uploadify.swf',
	    'uploader'    : 'view/admin/upload.php',
	    'buttonImage' : 'view/admin/uploadify-v3.1/choose.png',
	    'method'   : 'post',
	    'width' : 129,
	    'height' : 30,
	    'sizeLimit'   : 5120000,
	    'fileTypeExts'     : '*.jpg;*.png;*.gif;*.bmp',
	    'fileTypeDesc'    : 'Web Image Files (.JPG, .PNG, .GIF,.BMP)',
	    'auto'      : true,
	    'onInit': function (){},  
        'onSelect': function (){ 
            var OrderNo="";
            OrderNo=$("#OrderNo").val();
            $("#myFileId").uploadify("settings","formData",{'orderNO':OrderNo});
            $("#myFileId").uploadify("upload","*");
        },
  
	    // 单个文件上传成功时的处理函数
	    'onUploadSuccess' : function(file, data, response) 
		{  
		    var tel=$("#tel").val();
		    var filename="";
           
            var timeto=new Date();
            //alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            if(response) 
			{     
                 var OrderNo="";
                 OrderNo=$("#OrderNo").val();
                 $.ajax({
                 url: 'index.php?c=case&f=insetrimg&filename='+file.name+'&tim='+timeto.getSeconds()+'&tel='+tel+'&OrderNo='+OrderNo,   
                 type:'POST',      
                 sync: false,   
                 success: function(msg){
  		               alert(msg);
                       return true;  
                      }
                  });
            }
             else {
            	alert('上传发生错误');
                return false;
            }
   },
        // 单个文件上传失败时处理函数 
	    'onUploadError' : function(file, errorCode, errorMsg, errorString) 
		{
            alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
            return false;
        }        
	  }
   );
            
}


/*
 * 并保存投诉单的检查流程顺序
 * 1setp：业务号码是否为空
 * 2setp：业务号码是否为收费号码
 * 3setp：投诉内容是否为空
 */

function submitCheck（）{
    
    var tel=$("#tel").val();//获取业务号码
    var phone=$("#phone").val();
    if(tel<>""){
        var isSf=checkTelSf(tel);
        if(content<>''&& isSf){
           alert("保存成功") ;
            
        }
        
    }
    else{
        alert("业务电话号码不能为空");
    }
    
    
}
/*
 * 检查业务号码是否是收费号码
 */
function checkTelSf(var tel){
    
    $.ajax({
        url: 'index.php?c=case&f=checkTelSf&tel='+tel,   
        type: 'post',      
        async: false,   
        success: function(msg){
            return true;
        }
    });
    $("#right").slideToggle();
    
    
    
         <div id="p" class="easyui-panel" title="待办客服处理表"
            style="width:100%;height:350px;padding:10px;background:#fafafa;"
            data-options="iconCls:'icon-save',closable:true,
            collapsible:true,minimizable:true,maximizable:true" maximizable="false" 
            minimizable="false" closable="false" maximized="true">   
    
    
}


