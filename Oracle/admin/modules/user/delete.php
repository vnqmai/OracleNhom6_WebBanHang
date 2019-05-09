<?php 
	if (!is_admin()){
        redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
    }
    include_once "database/user.php";
	$id = input_get('idtk');
	if(!empty($id)){
		$status = delete_TK_by_ID($id);
		if($status == false)
			echo "Lỗi";
		else{
			echo "<script language='javascript'>
		    if (confirm('Bạn có chắc muốn xóa tài khoản này?')) {
		    </script>";
			    echo "<script language='javascript'>";
				echo "alert('Xóa tài khoản thành công');";    
				echo "history.back()";
				echo "</script>";
				//sleep(5);
				//redirect(base_url('admin'), array('m' => 'common', 'a' => 'dashboard')); 
		}		
	}
 ?>