<?php /** ��ںͶ���ȫ�ַ����Լ������ļ� */
define('CONFIG_DENIED',true);//���������ļ���������

if(!include('base/config.php'))  exit('Error:can not find config file');

header('Content-type: text/html;charset='.CHARSET);//�����ַ�����

if(DEBUG_MODEL){
    ini_set("display_errors","On");//����������Ϣ���
    error_reporting(E_ALL & ~E_NOTICE);//��������ʱ���󼶱�
}
else{
    ini_set("display_errors","0ff");
    error_reporting(0);
}

define('BASE_PATH',$_SERVER['DOCUMENT_ROOT'].'/'.ROOT_DIR.'/');//��Ŀ���Ը�·��

if(!include(BASE_PATH.'base/base.php'))  exit('Error:can not find base file');//ͨ�û�����

$control=($_GET['c'])?addslashes($_GET['c']).'Control':'loginControl';//�ñ���ָʾ�����ĸ�control��
$function=($_GET['f'])?addslashes($_GET['f']):'login_view';//�ñ���ָʾ�����ĸ�function



if(!include(BASE_PATH.'control/'.$control.'.php')) die('Error:can not find control:<b>'.$control.'<b>'); 

    ${$control}=new $control();
    
if(!method_exists(${$control},$function)) die('Error:can not find function in '.$control.' like:<b>'.$function.'<b>');     
 
    ${$control}->$function(); 

?>