<?php if (!defined('IN_SITE')) die ('The request not found');
 
	function db_user_get_by_username($username){
	    $username = addslashes($username);
	    $sql = "SELECT * FROM TAIKHOAN where TENDN = '{$username}'";	    
	    return db_get_row($sql);
	}

	function insert_TK($tendn,$matkhau,$hoten,$diachi,$sdt,$email,$loaitk){
		return execute("INSERT INTO TAIKHOAN VALUES ((select max(IDTAIKHOAN)+1 from TAIKHOAN),N'".$tendn."','".sha1($matkhau)."',N'".$hoten."',N'".$diachi."','".($sdt)."','".($email)."',".intval($loaitk).")");
	}
	function delete_TK_by_ID($id){
		return execute("DELETE TAIKHOAN WHERE IDTAIKHOAN = ".$id);
	}
	function get_TK_by_ID($id){
		return db_get_row("SELECT * FROM TAIKHOAN WHERE IDTAIKHOAN =".$id);
	}
	function update_TK_by_ID($id,$tendn,$matkhau,$hoten,$diachi,$sdt,$email,$loaitk){
		return execute("UPDATE TAIKHOAN SET TENDN = N'".$tendn."', MATKHAU = '".$matkhau."', HOTEN = N'".$hoten."', DIACHI = N'".$diachi."', SODIENTHOAI = '".($sdt)."', EMAIL = '".($email)."', LOAITK = ".intval($loaitk)." WHERE IDTAIKHOAN = ".$id);
	}
	function is_email($str) {
    	return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}
?>