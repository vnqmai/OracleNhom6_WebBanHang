<?php include_once 'header.php'; ?>
<div class="container">
	<div class="row">
		<form action="" method="POST" role="form">
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
</div>
<?php include_once 'footer.php'; ?>