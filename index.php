<?php /** 入口和定义全局方法以及变量文件 */
define('CONFIG_DENIED',true);//定义配置文件访问限制

if(!include('base/config.php'))  exit('Error:can not find config file');

header('Content-type: text/html;charset='.CHARSET);//定义字符编码

if(DEBUG_MODEL){
    ini_set("display_errors","On");//开启错误信息输出
    error_reporting(E_ALL & ~E_NOTICE);//报告运行时错误级别
}
else{
    ini_set("display_errors","0ff");
    error_reporting(0);
}

define('BASE_PATH',$_SERVER['DOCUMENT_ROOT'].'/'.ROOT_DIR.'/');//项目绝对根路径

if(!include(BASE_PATH.'base/base.php'))  exit('Error:can not find base file');//通用基础类

$control=($_GET['c'])?addslashes($_GET['c']).'Control':'loginControl';//该变量指示调用哪个control类
$function=($_GET['f'])?addslashes($_GET['f']):'login_view';//该变量指示调用哪个function



if(!include(BASE_PATH.'control/'.$control.'.php')) die('Error:can not find control:<b>'.$control.'<b>'); 

    ${$control}=new $control();
    
if(!method_exists(${$control},$function)) die('Error:can not find function in '.$control.' like:<b>'.$function.'<b>');     
 
    ${$control}->$function(); 

?>