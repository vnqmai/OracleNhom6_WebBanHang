<?php 
	if (!is_admin()){
        redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
    }
    include_once "database/bill.php";
	$id = input_get('idhd');
	if(!empty($id)){
		$status = delete_BIL_by_ID($id);
		if($status == false)
			echo "Lỗi";
		else{
			echo "Thành công.";
			sleep(1);
			redirect(base_url('admin'), array('m' => 'common', 'a' => 'dashboard'));
		}		
	}
 ?>