<?php if (!defined('BASE_PATH')) exit('Access denied!');

class loginControl {
    /** 登录页面*/
    function login_view(){
        $base=new base;
        $base->loadView('public/login');
    }
    /** 生成随机密码*/
    function create_password($pw_length = 8){
        $randpwd = '';//随机密码变量
        for ($i = 0; $i < $pw_length; $i++)
        {
            $randpwd .= chr(mt_rand(33, 126));
        }//循环结束
        return md5($randpwd);//md5加密
    }
    /** 处理登录*/
    function dologin(){
        $base=new base;
        $userId=$base->getVal('userId');
        $pass1=$base->getVal('pass1');
        $sql = 'select id,nickname,name,`group`,pass1 from tbl_emp 
        where id=\''.$userId.'\' or nickname=\''.$userId.'\''; 
        $row=$base->getResult($sql);
        /** 读取文件中指定用户密码*//*
        $file=fopen(BASE_PATH.'base/pw.txt',r) or exit("Unable to open file!");//打开密码串文件
        while(!feof($file)){
          $tmp = trim(fgets($file));//读取最后一个密码串存入变量
          if(!empty($tmp)){
            $pwstr = $tmp;
          }
        }//结束循环
        fclose($file);//关闭文件*/
       	if(($row['nickname']==$userId||$row['id']==$userId)&&$row['pass1']==$pass1)
        //if($userId=='admin'&&$pass1==$pwstr)
		{//判断用户是否相同,判断密码是否相同
			session_start();
            unset($row['pass1']);
            $_SESSION['user']=$row;
			//$_SESSION['user']['id']='admin'; 
            //$_SESSION['user']['nickname']='admin';
            //$_SESSION['user']['name']='管理员';
            //$_SESSION['user']['group']='1';
            $_SESSION['user']['ip']=$_SERVER[REMOTE_ADDR];
            $base->href('index.php?c=login&f=mainframe');
		}		
		else
		{
		  $base->href('index.php?c=login&f=fail&ch=用户名或密码有误!');
		}
       
    }
    /** 主页面*/
    function mainFrame(){
        $base=new base;
       $base->loadView('public/mainFrame');
    }
    /** 错误信息页面*/
    function fail(){
        $base=new base;
        $ch=$base->getVal('ch');
        $base->loadView('public/fail',
        array('ch'=>$ch)
        );
    }   
    /** 登出处理*/
    function logout(){
            session_start();
        	session_unset();
        	session_destroy();
        	header("location:index.php");
    }
    
} 
?>