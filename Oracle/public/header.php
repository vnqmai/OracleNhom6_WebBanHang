<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Oracle nhóm 6 | Web bán giày</title>
	<meta charset="UTF-8">
	<meta name="description" content=" Oracle nhóm 6 | Web bán giày">
	<meta name="keywords" content="Oracle nhóm 6,Web bán giày">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/Chanut-Women-Shoes-Ankle-strap-pump.ico" rel="shortcut icon"/> 

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/flaticon.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
	<link rel="stylesheet" href="css/jquery-ui.min.css"/>
	<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/style.css"/>

	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="index.php" class="site-logo">
							<img src="img/logo.png" alt="">
						</a>
					</div>
					<div class="col-xl-6 col-lg-5">
						
					</div>
					<div class="col-xl-4 col-lg-5">
						<div class="user-panel">			
						<?php 
							session_start();
							if(!isset($_SESSION['iduser'])){								
						 ?>				
							<div class="up-item">
								<i class="flaticon-profile"></i>
								<a href="signin.php">Đăng nhập </a> | <a href="register.php">Đăng ký</a>
							</div>							
						<?php 
							}
							else{
						 ?>
						 <div class="up-item">
								<i class="flaticon-profile"></i>
								<a href="signout.php">Đăng xuất </a> | <a href="bill.php?id=<?php echo($_SESSION['iduser']); ?>">Lịch sử đặt hàng</a>
							</div>
						 <?php 
							}
						  ?>
							<div class="up-item">
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
									<span>0</span>
								</div>
								<a href="cart.php">Giỏ hàng</a>								
								<div id="dialog-confirm" title="Thông báo">
								  <p style="display: none;"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Thêm giỏ hàng thành công.</p>
								</div>								
							</div>							
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
				<ul class="main-menu">
					<li><a href="index.php">Trang chủ</a></li>
					<li><a href="category.php">Sản phẩm</a></li>
					<li><a href="cart.php">Giỏ hàng</a></li>
					<li><a href="checkout.php">Thanh toán</a></li>					
					<li><a href="contact.php">Liên hệ</a></li>										
				</ul>
			</div>
		</nav>
	</header>
	<!-- Header section end -->