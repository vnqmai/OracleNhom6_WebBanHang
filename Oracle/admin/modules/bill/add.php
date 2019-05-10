<?php 
	if (!is_admin()){
        redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
    }
 ?>

 <?php 
 //	$listloai = db_get_list("SELECT IDLOAISP, TENLOAISP FROM LOAISANPHAM");
 //$listthuonghieu = db_get_list("SELECT IDTHUONGHIEU, TENTHUONGHIEU FROM THUONGHIEU"); 	
  ?>
<?php 
	include_once "database/bill.php";
	if(is_submit('addbill')){	
		$error = "";	
		$ngaylap = input_post('ngaylap');		
		$trangthai = input_post('trangthai');		
		$taikhoan = input_post('taikhoan');
		$sanpham = input_post('sanpham');
		$soluong = input_post('soluong');
		$thanhtien = input_post('thanhtien');
		if(empty($ngaylap)){
			$error['ngaylap'] = 'Bạn chưa nhập ngày lập hóa đơn.';
		}
		if(empty($trangthai)){
			$error['trangthai'] = 'Bạn chưa nhập trạng thái hóa đơn .';
		}
		if(empty($taikhoan)){
			$error['taikhoan'] = 'Bạn chưa nhập tài khoản lập hóa đơn.';
		}		
		if(empty($sanpham)){
			$error['sanpham'] = 'Bạn chưa nhập loại sản phẩm.';
		}
		if(empty($soluong)){
			$error['soluong'] = 'Bạn chưa nhập số lượng ';
		}
		if(empty($thanhtien)){
			$error['thanhtien'] = 'Bạn chưa nhập thành tiền.';
		}			

		if(!$error){
			//$filename = uploadfile($file);			
			//$filehoverstring = uploadfiles($files);
			//if($filename!='File lỗi' && gettype($filehoverstring)!='array'){
				echo insert_HD($ngaylap,$trangthai,$taikhoan);
				echo insert_CTHD($sanpham,$soluong,$thanhtien);
			//}
		}		
	}
 ?>
<?php 
	include_once "widgets/header.php";
 ?>
  <div class="col-md-8 col-md-push-2 col-md-pull-2">
  	<form action="?m=bill&a=add" method="POST" role="form" enctype="multipart/form-data">
	  	<legend>Thêm hóa đơn</legend>
	  
	  	<div class="form-group">
	  		<label for="NGAYLAP">Ngày lập</label>
	  		<input type="date" class="form-control" name="ngaylap" id="ngaylap">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('addbill')){
	  					if(!empty($error['ngaylap'])){
	  						echo $error['ngaylap'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
		<div class="form-group">
	  		<label for="TRANGTHAI">Trạng thái</label>
	  		<input type="text" class="form-control" name="trangthai" id="trangthai">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('addbill')){
	  					if(!empty($error['trangthai'])){
	  						echo $error['trangthai'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>	  
	  	<div class="form-group">
	  		<label for="TAIKHOAN">ID tài khoản</label>
	  		<input type="number" class="form-control" name="taikhoan" id="taikhoan">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('addbill')){
	  					if(!empty($error['taikhoan'])){
	  						echo $error['taikhoan'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	<div class="form-group">
	  		<label for="SANPHAM">ID Sản phẩm</label>
	  		<input type="number" class="form-control" name="sanpham" id="sanpham">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('addbill')){
	  					if(!empty($error['sanpham'])){
	  						echo $error['sanpham'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	<div class="form-group">
	  		<label for="SOLUONG">Số lượng</label>
	  		<input type="number" class="form-control" name="soluong" id="soluong">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('addbill')){
	  					if(!empty($error['soluong'])){
	  						echo $error['soluong'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	<div class="form-group">
	  		<label for="THANHTIEN">Thành tiền</label>
	  		<input type="number" class="form-control" name="thanhtien" id="thanhtien">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('addbill')){
	  					if(!empty($error['thanhtien'])){
	  						echo $error['thanhtien'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	
		<input type="hidden" name="request" value="addbill">	  
	  	<button type="submit" class="btn btn-primary">Thêm</button>
	  </form>
  </div>

<?php 
	include_once "widgets/footer.php";
 ?>

 <style type="text/css">
 	.error{color: red;}
 </style>