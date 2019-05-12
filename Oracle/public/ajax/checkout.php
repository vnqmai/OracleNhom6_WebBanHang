<?php 	
	session_start();
	include_once '../../libs/database.php';
	$status = "";
	$user;
	$data = $_POST['data'];
	$data = json_decode($data,true);
	if(count($data)==0){
		$status = 'Giỏ rỗng <br><a href="category.php">Tiếp tục mua sắm.</a>';
	}
	else{
		if(isset($_SESSION['username'])){
			$username = $_SESSION['username'];
			$sql = "SELECT * FROM TAIKHOAN WHERE TENDN = '".$username."'";
			$user = db_get_list($sql);
		}	
		else
			$status = 'Chưa đăng nhập.';

		$sql = "INSERT INTO HOADON VALUES((select max(IDHOADON)+1 from HOADON),(SELECT SYSDATE FROM DUAL),N'Đang giao',".$_SESSION['iduser'].")";		
		if(execute($sql)){				
			$e = 0;
			for($i = 0;$i<count($data);++$i){
				if(execute('UPDATE SANPHAM SET SOLUONGCON = SOLUONGCON -'.intval($data[$i]['soluong']).', SOLUONGDABAN = SOLUONGDABAN + '.intval($data[$i]['soluong']).' WHERE IDSANPHAM = '.$data[$i]['id']))
				{
					if(execute("INSERT INTO CHITIETHOADON VALUES((select max(IDCHITIETHD)+1 from CHITIETHOADON),'".$data[$i]['id']."',".$data[$i]['soluong'].",".$data[$i]['soluong']*$data[$i]['dongia'].",(select max(IDHOADON) from HOADON))"))
							continue;
					else
						$e = 1;									
				}				
			}
			if($e!=0){
				$status = "Thêm chi tiết hóa đơn thất bại.";
			}
			else
				$status = "Thanh toán thành công. <br><a href='bill.php?id=".$_SESSION['iduser']."'>Xem hóa đơn.</a>";
		}	
		else{
			$status = 'Thêm hóa đơn thất bại.';
		}
	}	
 ?>
 <p><?php echo $status; ?></p>
