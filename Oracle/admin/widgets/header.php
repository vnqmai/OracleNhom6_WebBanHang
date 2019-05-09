<?php if (!defined('IN_SITE')) die('The request not found'); ?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="../libs/jquery.js"></script>
	<script type="text/javascript" src="../libs/Chart.min.js"></script>
	<script type="text/javascript" src="../libs/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="../libs/bootstrap.css">
	
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo create_link(base_url("admin"),array('m' => 'common', 'a' => 'dashboard' )); ?>">Giày N6</a>
			</div>
	
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li class="active">
						<a href="<?php echo create_link(base_url("admin"),array('m' => 'common', 'a' => 'dashboard' )); ?>"">Trang quản trị</a>
					</li>					
				</ul>				
				<ul class="nav navbar-nav navbar-right">						
					<li>
						<?php if(is_logged()) echo '<a href="?m=common&a=logout">Đăng xuất</a>'; else echo '<a href="?m=common&a=login">Đăng nhập</a>';?>		
					</li>
					<li class="dropdown">						
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Chức năng <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo create_link(base_url("admin"),array('m' => 'product', 'a' => 'list')); ?>">Quản lý sản phẩm</a></li>
							<li><a href="<?php echo create_link(base_url("admin"),array('m' => 'user', 'a' => 'list')); ?>">Quản lý tài khoản</a></li>
							<li><a href="<?php echo create_link(base_url("admin"),array('m' => 'bill', 'a' => 'list')); ?>">Quản lý đơn hàng</a></li>														
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>
</head>
<body>

