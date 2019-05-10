<?php 
	if(!is_admin()){
		redirect(base_url("admin"),array('m' => 'common', 'a' => 'logout'));
	}
	include_once "database/user.php";
	$id = input_get('idtk');
	$status = "";
	if(!empty($id)){
		$taikhoan = get_TK_by_ID($id);
	}
	if(is_submit("edituser")){
		$error = "";	
		$tendn = input_post('tendn');		
		$matkhau= input_post('matkhau');
		$hoten = input_post('hoten');
		$diachi = input_post('diachi');
		$sdt = input_post('sdt');
		$email = input_post('email');
		$loaitk = 2;
		
		if(empty($tendn)){
			$error['tendn'] = 'Bạn chưa nhập tên tài khoản.';
		}	
		if(empty($matkhau)){
			$error['matkhau'] = 'Bạn chưa nhập mật khẩu.';
		}
		if(empty($hoten)){
			$error['hoten'] = 'Bạn chưa nhập họ tên.';
		}
		if(empty($diachi)){
			$error['diachi'] = 'Bạn chưa nhập địa chỉ.';
		}	
		if(empty($sdt)){
			$error['sdt'] = 'Bạn chưa nhập số điện thoại.';
		}		
		if(empty($email)){
			$error['email'] = 'Bạn chưa nhập địa chỉ email.';
		}else if (!is_email($email)){
        	$error['email'] = 'Email không đúng định dạng';
    	}		
		if(!$error){									
				if(update_TK_by_ID($id,$tendn,sha1($matkhau),$hoten,$diachi,$sdt,$email,$loaitk))
					$status = "Thành công. <br><a href='".create_link(base_url('admin'),array('m' => "user",'a'=>"list" ))."'>Trở lại</a>";
				else
					$status = "Thất bại.";
				// echo "<script>";
				// echo "alert('Đã lưu thành công');";    
				// echo "history.back()";
				// echo "</script>";
			}			
		}
		else{
			$status = "Sai";
		}
 ?>
 <?php 
 	$listloai = db_get_list("SELECT IDLOAITK, TENLOAITK FROM LOAITAIKHOAN");
  ?>
  <?php 
	include_once "widgets/header.php";
 ?>
  <div class="col-md-8 col-md-push-2 col-md-pull-2">
  	<form action="<?php echo '?m=user&a=edit&idtk='.$id; ?>" method="POST" role="form" enctype="multipart/form-data">
	  	<legend>Thay đổi thông tin tài khoản</legend>
	  
	  	<div class="form-group">
	  		<label for="TENDN">Tên tài khoản</label>
	  		<input type="text" class="form-control" name="tendn" id="tendn" value="<?php echo $taikhoan['TENDN'][0]; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('edituser')){
	  					if(!empty($error['tendn'])){
	  						echo $error['tendn'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
		<div class="form-group">
	  		<label for="MATKHAU">Mật khẩu</label>
	  		<input type="password" class="form-control" name="matkhau" id="matkhau" value="<?php echo $taikhoan['MATKHAU'][0]; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('edituser')){
	  					if(!empty($error['matkhau'])){
	  						echo $error['matkhau'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>	  
	  	<div class="form-group">
	  		<label for="HOTEN">Họ tên</label>
	  		<!-- <input type="te" class="form-control" name="dongia" id="dongia"> -->
	  		<textarea class="form-control" name="hoten" id="hoten"><?php echo $taikhoan['HOTEN'][0]; ?></textarea>
	  		<span class="error">
	  			<?php 
	  				if(is_submit('edituser')){
	  					if(!empty($error['hoten'])){
	  						echo $error['hoten'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>	  
	  	<div class="form-group">
	  		<label for="DIACHI">Địa chỉ</label>
	  		<!-- <input type="te" class="form-control" name="dongia" id="dongia"> -->
	  		<textarea class="form-control" name="diachi" id="diachi"><?php echo $taikhoan['DIACHI'][0]; ?></textarea>
	  		<span class="error">
	  			<?php 
	  				if(is_submit('edituser')){
	  					if(!empty($error['diachi'])){
	  						echo $error['diachi'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>	  
	  	<div class="form-group">
	  		<label for="SODIENTHOAI">Số điện thoại</label>
	  		<input type="text" class="form-control" name="sdt" id="sdt" value="<?php 
	  		echo $taikhoan['SODIENTHOAI'][0]; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('edituser')){
	  					if(!empty($error['sdt'])){
	  						echo $error['sdt'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	<div class="form-group">
	  		<label for="EMAIL">Địa chỉ Email</label>
	  		<input type="text" class="form-control" name="email" id="email"  value="<?php echo $taikhoan['EMAIL'][0]; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('edituser')){
	  					if(!empty($error['email'])){
	  						echo $error['email'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>	  	
		<input type="hidden" name="request" value="edituser">	  
	  	<button type="submit" class="btn btn-primary">Lưu thay đổi</button>
	  </form>
	  <div style="text-align: center;"><?php if($status!="") echo $status; ?></div>
  </div>

<?php 
	include_once "widgets/footer.php";
 ?>