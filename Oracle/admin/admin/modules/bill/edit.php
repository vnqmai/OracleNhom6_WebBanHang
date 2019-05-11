<?php 
	if(!is_admin()){
		redirect(base_url("admin"),array('m' => 'common', 'a' => 'logout'));
	}
	include_once "database/bill.php";
	$id = input_get('idct');
	if(!empty($id)){
		$bill = get_BIL_by_ID($id);
	}
	if(is_submit("editbill")){
		$error = "";	
		$ngaylap = input_post('ngaylap');		
		$trangthai = input_post('trangthai');		
		$taikhoan = input_post('taikhoan');
		$sanpham = input_post('sanpham');
		$soluong = input_post('soluong');
		$thanhtien = input_post('thanhtien');
		$idhd = input_post('idhd');
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
				echo update_BIL_by_ID($idhd,$ngaylap,$trangthai,$taikhoan);
				echo update_BIL_DETAIL_by_ID($id,$idhd,$sanpham,$soluong,$thanhtien);
			}			
		}

 ?>
 
  <?php 
	include_once "widgets/header.php";
 ?>
  <div class="col-md-8 col-md-push-2 col-md-pull-2">
  	<form action="<?php echo '?m=bill&a=edit&idct='.$id; ?>" method="POST" role="form" enctype="multipart/form-data">
	  	<legend>Chỉnh sửa hóa đơn</legend>
	  
	  	<div class="form-group">
	  		<label for="NGAYLAP">Ngày lập</label>
	  		<input type="text" class="form-control" name="ngaylap" id="ngaylap" value="<?php echo $bill['NGAYLAP'][0]; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('editbill')){
	  					if(!empty($error['ngaylap'])){
	  						echo $error['ngaylap'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	<div class="form-group">
	  		<label for="TRANGTHAI">Trạng thái</label>
	  		<input type="text" class="form-control" name="trangthai" id="trangthai" value="<?php echo $bill['TRANGTHAI'][0]; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('editbill')){
	  					if(!empty($error['trangthai'])){
	  						echo $error['trangthai'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	<div class="form-group">
	  		<label for="TAIKHOAN">ID Tài Khoản</label>
	  		<input type="number" class="form-control" name="taikhoan" id="taikhoan" value="<?php echo $bill['TAIKHOAN'][0]; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('editbill')){
	  					if(!empty($error['taikhoan'])){
	  						echo $error['taikhoan'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	<div class="form-group">
	  		<label for="SANPHAM">ID Sản Phẩm</label>
	  		<input type="number" class="form-control" name="sanpham" id="sanpham" value="<?php echo $bill['SANPHAM'][0]; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('editbill')){
	  					if(!empty($error['sanpham'])){
	  						echo $error['sanpham'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	<div class="form-group">
	  		<label for="SOLUONG">Số lượng</label>
	  		<input type="number" class="form-control" name="soluong" id="soluong" value="<?php echo $bill['SOLUONG'][0]; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('editbill')){
	  					if(!empty($error['soluong'])){
	  						echo $error['soluong'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	<div class="form-group">
	  		<label for="THANHTIEN">Thành tiền</label>
	  		<input type="number" class="form-control" name="thanhtien" id="thanhtien" value="<?php echo $bill['THANHTIEN'][0]; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('editbill')){
	  					if(!empty($error['thanhtien'])){
	  						echo $error['thanhtien'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	<div class="form-group"  style="display: none;">
	  		<label for="IDHD">IDHD</label>
	  		<input type="text" class="form-control" name="idhd" id="idhd" value="<?php echo $bill['HOADON'][0]; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('editbill')){
	  					if(!empty($error['idhd'])){
	  						echo $error['idhd'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
		<input type="hidden" name="request" value="editbill">	  
	  	<button type="submit" class="btn btn-primary">Sửa</button>
	  </form>
  </div>

<?php 
	include_once "widgets/footer.php";
 ?>