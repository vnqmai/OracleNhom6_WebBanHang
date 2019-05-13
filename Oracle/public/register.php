<?php include_once 'header.php'; ?>
<?php 
	include_once '../libs/database.php';
	//include_once '../admin/database/user.php';	
	$status = "";
	if(isset($_POST['submit'])){
		$tendn = $_POST['username'];
		$matkhau = $_POST['password'];
		$matkhau1 = $_POST['password1'];
		$name = $_POST['Name'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$sql = "INSERT INTO TAIKHOAN VALUES ((select max(IDTAIKHOAN)+1 from TAIKHOAN),N'".$tendn."','".sha1($matkhau)."',N'".$name."',N'".$address."','".($phone)."','".($email)."',2";
		//$user = db_get_list($sql);				
			if($matkhau==$matkhau1){
				 execute("INSERT INTO TAIKHOAN VALUES ((select max(IDTAIKHOAN)+1 from TAIKHOAN),N'".$tendn."','".sha1($matkhau)."',N'".$name."',N'".$address."','".($phone)."','".($email)."',2)");
				$status = "Đăng kí thành công. <br><a href = 'signin.php'>Trở về.</a>";
			}			
			else
				{$status = "Mật khẩu và xác nhận không khớp";}
		}
		
			
 ?>

<div class="container">
	<div class="row">
		<form action="" method="POST" role="form" style="margin: auto;" enctype="multipart/form-data">
			<legend>Đăng ký tài khoản</legend>
		
			<div class="form-group">
				<label for="">Tên tài khoản</label>
				<input type="text" class="form-control" id="username" name="username">
			</div>
		
			<div class="form-group">
				<label for="">Mật khẩu</label>
				<input type="password" class="form-control" id="password" name="password">
			</div>
			<div class="form-group">
				<label for="">Nhập lại mật khẩu</label>
				<input type="password" class="form-control" id="password1" name="password1">
			</div>
			<div class="form-group">
				<label for="">Họ tên</label>
				<input type="text" class="form-control" id="Name" name="Name">
			</div>	
			<div class="form-group">
				<label for="">Địa chỉ</label>
				<input type="text" class="form-control" id="address" name="address">
			</div>	
			<div class="form-group">
				<label for="">Số điện thoại</label>
				<input type="text" class="form-control" id="phone" name="phone">
			</div>
			<div class="form-group">
				<label for="">Email</label>
				<input type="email" class="form-control" id="email" name="email">
			</div>

		
			<button type="submit" class="btn btn-primary" id="submit" name="submit">Đăng Ký</button>
		</form>		
	</div>
	<div style="text-align: center;"><?php if($status!="") echo $status; ?></div>
</div>
<?php include_once 'footer.php'; ?>