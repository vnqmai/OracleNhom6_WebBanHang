<?php if (!defined('IN_SITE')) die ('The request not found');
 
	function db_user_get_by_username($username){
	    $username = addslashes($username);
	    $sql = "SELECT * FROM TAIKHOAN where TENDN = '{$username}'";	    
	    return db_get_row($sql);
	}
?>