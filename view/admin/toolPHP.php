
<td><a class="thickbox"  href='index.php?c=plan&f=case_detail&c_id=<?= $val['c_id']?>&Dgtime=<?=$val['DgTime']?>&height=450&width=550&modal=true'>�ص�</a></td>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getHistory(){
    var tel=$("#tel").val();
    if(tel==null||tel.replace(/^\s\s*/,'').replace(/\s\s*$/,'')==''){
        alert('����дҵ��绰');
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
ͼƬ�ϴ�  2012��8��13�� �콨?]
change ��ʾ���ؿؼ�
uploadify ͼƬ�ϴ�
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
  
	    // �����ļ��ϴ��ɹ�ʱ�Ĵ�����
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
            	alert('�ϴ���������');
                return false;
            }
   },
        // �����ļ��ϴ�ʧ��ʱ������ 
	    'onUploadError' : function(file, errorCode, errorMsg, errorString) 
		{
            alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
            return false;
        }        
	  }
   );
            
}


/*
 * ������Ͷ�ߵ��ļ������˳��
 * 1setp��ҵ������Ƿ�Ϊ��
 * 2setp��ҵ������Ƿ�Ϊ�շѺ���
 * 3setp��Ͷ�������Ƿ�Ϊ��
 */

function submitCheck����{
    
    var tel=$("#tel").val();//��ȡҵ�����
    var phone=$("#phone").val();
    if(tel<>""){
        var isSf=checkTelSf(tel);
        if(content<>''&& isSf){
           alert("����ɹ�") ;
            
        }
        
    }
    else{
        alert("ҵ��绰���벻��Ϊ��");
    }
    
    
}
/*
 * ���ҵ������Ƿ����շѺ���
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
    
    
    
         <div id="p" class="easyui-panel" title="����ͷ������"
            style="width:100%;height:350px;padding:10px;background:#fafafa;"
            data-options="iconCls:'icon-save',closable:true,
            collapsible:true,minimizable:true,maximizable:true" maximizable="false" 
            minimizable="false" closable="false" maximized="true">   
    
    
}


