<?php
	/**
	 * ��¼�ж�
	 */
    $login_control= new base();
 	session_start();
	if(!$_SESSION['user']){
		$ch = 'δ��¼';
        $login_control->href('index.php?c=login&f=fail&ch='.$ch);
	}
?>

