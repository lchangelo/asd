<?php if (!defined('BASE_PATH')) exit('Access denied!');

class loginControl {
    /** ��¼ҳ��*/
    function login_view(){
        $base=new base;
        $base->loadView('public/login');
    }
    /** �����������*/
    function create_password($pw_length = 8){
        $randpwd = '';//����������
        for ($i = 0; $i < $pw_length; $i++)
        {
            $randpwd .= chr(mt_rand(33, 126));
        }//ѭ������
        return md5($randpwd);//md5����
    }
    /** �����¼*/
    function dologin(){
        $base=new base;
        $userId=$base->getVal('userId');
        $pass1=$base->getVal('pass1');
        $sql = 'select id,nickname,name,`group`,pass1 from tbl_emp 
        where id=\''.$userId.'\' or nickname=\''.$userId.'\''; 
        $row=$base->getResult($sql);
        /** ��ȡ�ļ���ָ���û�����*//*
        $file=fopen(BASE_PATH.'base/pw.txt',r) or exit("Unable to open file!");//�����봮�ļ�
        while(!feof($file)){
          $tmp = trim(fgets($file));//��ȡ���һ�����봮�������
          if(!empty($tmp)){
            $pwstr = $tmp;
          }
        }//����ѭ��
        fclose($file);//�ر��ļ�*/
       	if(($row['nickname']==$userId||$row['id']==$userId)&&$row['pass1']==$pass1)
        //if($userId=='admin'&&$pass1==$pwstr)
		{//�ж��û��Ƿ���ͬ,�ж������Ƿ���ͬ
			session_start();
            unset($row['pass1']);
            $_SESSION['user']=$row;
			//$_SESSION['user']['id']='admin'; 
            //$_SESSION['user']['nickname']='admin';
            //$_SESSION['user']['name']='����Ա';
            //$_SESSION['user']['group']='1';
            $_SESSION['user']['ip']=$_SERVER[REMOTE_ADDR];
            $base->href('index.php?c=login&f=mainframe');
		}		
		else
		{
		  $base->href('index.php?c=login&f=fail&ch=�û�������������!');
		}
       
    }
    /** ��ҳ��*/
    function mainFrame(){
        $base=new base;
       $base->loadView('public/mainFrame');
    }
    /** ������Ϣҳ��*/
    function fail(){
        $base=new base;
        $ch=$base->getVal('ch');
        $base->loadView('public/fail',
        array('ch'=>$ch)
        );
    }   
    /** �ǳ�����*/
    function logout(){
            session_start();
        	session_unset();
        	session_destroy();
        	header("location:index.php");
    }
    
} 
?>