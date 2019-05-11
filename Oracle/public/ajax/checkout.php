<?php 	
	$status = "";
	$user;
	$data = $_POST['data'];
	$data = json_decode($data);
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
		$sql = "SELECT * FROM TAIKHOAN WHERE TENDN = '".$username."'";
		$user = db_get_list($sql);
	}	
	$sql = 'INSERT INTO HOADON VALUES((select max(IDHOADON)+1 from HOADON),to_date('.date('dd/mm/yyyy').",'dd-MM-yyyy hh:mi:ss'),N'Đang giao',".$_SESSION['iduser'].")";
			if(execute($sql)){				
				$e = 0;
				for($i = 0;$i<count($data);++$i){
					if(execute("INSERT INTO CHITIETHOADON VALUES((select max(IDCHITIETHD)+1 from CHITIETHOADON),'".$data['id']."',".$data['soluong'].",".$data['soluong']*$data['dongia'].",(select max(IDHOADON)+1 from HOADON))"))
						continue;
					else
						$e = 1;									
				}
				if($e!=0){
					$status = "Thêm chi tiết hóa đơn thất bại.";
				}
				else
					$status = "Thanh toán thành công.";
			}	
			else{
				$status = 'Thêm hóa đơn thất bại.';
			}
 ?>
 <p><?php echo $status; ?></p>