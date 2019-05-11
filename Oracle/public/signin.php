<?php 
	include_once '../libs/database.php';
	session_start();
	$status = "";
	if(isset($_POST['submit'])){
		$tendn = $_POST['username'];
		$matkhau = $_POST['password'];
		$sql = "SELECT * FROM TAIKHOAN WHERE TENDN = '".$tendn."'";
		$user = db_get_list($sql);				
		if(count($user['IDTAIKHOAN'])>0){
			if(bin2hex($user['MATKHAU'][0])==sha1($matkhau)){				
				$_SESSION['username'] = $tendn;
				$_SESSION['iduser'] = $user['IDTAIKHOAN'][0];
				$status = "Thành công. <br><a href='#' onclick='history.back();'>Trở về.</a>";
			}			
			else
				$status = "Mật khẩu không đúng.";
		}
		else
			$status = "Thất bại.";
	}
 ?>
<?php include_once 'header.php'; ?>
<div class="container">
	<div class="row">
		<form action="" method="POST" role="form" style="margin: auto;">
			<legend>Đăng nhập</legend>
		
			<div class="form-group">
				<label for="">Tên đăng nhập</label>
				<input type="text" class="form-control" id="username" name="username">
			</div>
		
			<div class="form-group">
				<label for="">Mật khẩu</label>
				<input type="text" class="form-control" id="password" name="password">
			</div>	
		
			<button type="submit" class="btn btn-primary" id="submit" name="submit">Đăng nhập</button>
		</form>		
	</div>
	<div style="text-align: center;"><?php if($status!="") echo $status; ?></div>
</div>
<?php include_once 'footer.php'; ?>