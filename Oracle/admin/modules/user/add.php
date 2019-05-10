<?php 
	if (!is_admin()){
        redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
    }
 ?>

 <?php 
 	$listloai = db_get_list("SELECT IDLOAITK, TENLOAITK FROM LOAITAIKHOAN");
  ?>
<?php 
	include_once "database/user.php";
	$status = "";
	if(is_submit('adduser')){	
		$error='';
		$nameErr = "";	
		$pattern = '#^\(?[\d]{3}\)?-\(?[\d]{2}\)?-[\d]{2}\.[\d]{3}-[\d]{3}$#';
		$tendn = input_post('tendn');		
		$matkhau= input_post('matkhau');
		$hoten = input_post('hoten');
		$diachi = input_post('diachi');
		$sdt = input_post('sdt');
		$email = input_post('email');
		$loaitk = input_post('loaitk');
		if (empty($_POST["tendn"])) {
               $error['tendn'] = "Bạn phải nhập tên đăng nhập";
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
		}else if(preg_match($pattern, $sdt) == 1){
			$error['sdt'] = 'Số điện thoại không hợp lệ.';
		}
		if(empty($email)){
			$error['email'] = 'Bạn chưa nhập địa chỉ email.';
		}else if (!is_email($email)){
        	$error['email'] = 'Email không đúng định dạng';
    	}		
		
		if(!$error){
				if(insert_TK($tendn,$matkhau,$hoten,$diachi,$sdt,$email,2))
					$status = "Thành công. <br><a href='".create_link(base_url('admin'), array('m' => 'user', 'a' => 'list'))."'>Trở lại.</a>";
				else
					$status = "Thất bại.";
				echo "<script>";
				echo "alert('Thêm thành công');";    
				//echo "history.back()";
				echo "</script>";
		}		
	}
 ?>
<?php 
	include_once "widgets/header.php";
 ?>
  <div class="col-md-8 col-md-push-2 col-md-pull-2">
  	<form action="?m=user&a=add" method="POST" role="form" enctype="multipart/form-data">
	  	<legend>Thêm tài khoản</legend>
	  
	  	<div class="form-group">
	  		<label for="TENTAIKHOAN">Tên tài khoản</label>
	  		<input type="text" class="form-control" name="tendn" id="tendn" value="<?php echo isset($tendn) ? $tendn : ''; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('adduser')){
	  					if(!empty($error['tendn'])){
	  						echo $error['tendn'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
		<div class="form-group">
	  		<label for="MATKHAU">Mật khẩu</label>
	  		<input type="password" class="form-control" name="matkhau" id="matkhau" value="<?php echo isset($matkhau) ? $matkhau : ''; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('adduser')){
	  					if(!empty($error['matkhau'])){
	  						echo $error['matkhau'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>	  
	  	<div class="form-group">
	  		<label for="HOTEN">Họ tên</label>
	  		<input type="text" class="form-control" name="hoten" id="hoten" value="<?php echo isset($hoten) ? $hoten : ''; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('adduser')){
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
	  		<input type="text" class="form-control" name="diachi" id="diachi" value="<?php echo isset($diachi) ? $diachi : ''; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('adduser')){
	  					if(!empty($error['diachi'])){
	  						echo $error['diachi'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>	  
	  	<div class="form-group">
	  		<label for="SDT">Số điện thoại</label>
	  		<input type="text" class="form-control" name="sdt" id="sdt" value="<?php echo isset($sdt) ? $sdt : ''; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('adduser')){
	  					if(!empty($error['sdt'])){
	  						echo $error['sdt'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	<div class="form-group">
	  		<label for="EMAIL">Địa chỉ email</label>
	  		<input type="text" class="form-control" name="email" id="email" value="<?php echo isset($email) ? $email : ''; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('adduser')){
	  					if(!empty($error['email'])){
	  						echo $error['email'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
		<input type="hidden" name="request" value="adduser">	  
	  	<button type="submit" class="btn btn-primary">Thêm</button>
	  </form>
	  <div style="text-align: center;"><?php if($status!="") echo $status; ?></div>
  </div>

<?php 
	include_once "widgets/footer.php";
 ?>

 <style type="text/css">
 	.error{color: red;}
 </style>