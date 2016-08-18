<?php
	/**
	 * µÇÂ¼ÅÐ¶Ï
	 */
    $login_control= new base();
 	session_start();
	if(!$_SESSION['user']){
		$ch = 'Î´µÇÂ¼';
        $login_control->href('index.php?c=login&f=fail&ch='.$ch);
	}
?>

