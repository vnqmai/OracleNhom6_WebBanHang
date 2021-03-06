<?php 
	include_once '../libs/database.php';
	$sql = 'SELECT * FROM SANPHAM WHERE SOLUONGCON > 0 ORDER BY IDSANPHAM DESC';
	$latest = db_get_list($sql);
	$sql = 'SELECT * FROM SANPHAM WHERE SOLUONGCON > 0  ORDER BY SOLUONGDABAN DESC';
	$bestsell = db_get_list($sql);
	$sql = 'SELECT * FROM LOAISANPHAM';
	$filter = db_get_list($sql);
 ?>

<?php include_once('header.php'); ?>
	<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<div class="hs-item set-bg" data-setbg="../images/slide-2.jpg">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 text-white">
							<span>Mới về</span>
							<h2>Giày dép cao cấp</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
							<a href="category.php" class="site-btn sb-line">XEM NGAY</a>							
						</div>
					</div>
					<div class="offer-card text-white">
						<span>chỉ từ</span>
						<h2>300k</h2>
						<p>MUA NGAY</p>
					</div>
				</div>
			</div>
			<div class="hs-item set-bg" data-setbg="../images/slide-1.jpg">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 text-white">
							<span>New Arrivals</span>
							<h2>denim jackets</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
							<a href="category.php" class="site-btn sb-line">XEM NGAY</a>							
						</div>
					</div>
					<div class="offer-card text-white">
						<span>from</span>
						<h2>$29</h2>
						<p>SHOP NOW</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="slide-num-holder" id="snh-1"></div>
		</div>
	</section>
	<!-- Hero section end -->



	<!-- Features section -->
	<section class="features-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="img/icons/1.png" alt="#">
						</div>
						<h2>Thanh toán nhanh</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="img/icons/2.png" alt="#">
						</div>
						<h2>Sản phẩm chất lượng</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="img/icons/3.png" alt="#">
						</div>
						<h2>Giao hàng tận nơi</h2>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Features section end -->


	<!-- letest product section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2>SẢN PHẨM MỚI NHẤT</h2>
			</div>
			<div class="product-slider owl-carousel">
				<?php 
					for($i = 0;$i<5;++$i){				
				?>				
				<div class="product-item">										
					<div class="pi-pic">
						<img src="../images/<?php echo($latest['HINH'][$i]); ?>" alt="" style="height: 300px;">
						<div class="pi-links">
							<a style="cursor: pointer;" class="add-card" value="<?php echo $latest['IDSANPHAM'][$i]; ?>"><i class="flaticon-bag"></i><span>THÊM VÀO GIỎ</span></a>											
						</div>
					</div>
					<div class="pi-text">
						<h6><?php echo $latest['DONGIA'][$i]; ?></h6>
						<p><a href="product.php?id=<?php echo $latest['IDSANPHAM'][$i]; ?>"><?php echo $latest['TENSANPHAM'][$i]; ?></a></p>
					</div>					
				</div>					
				<?php
					}
				 ?>						
			</div>
		</div>
	</section>
	<!-- letest product section end -->



	<!-- Product filter section -->
	<section class="product-filter-section">
		<div class="container">
			<div class="section-title">
				<h2>SẢN PHẨM BÁN CHẠY</h2>
			</div>
			<ul class="product-filter-menu">
				<?php 
					for($i = 0;$i<count($filter['IDLOAISP']);++$i){										
				 ?>
				 <li><a href="category.php?id=<?php echo $filter['IDLOAISP'][$i]; ?>"><?php echo $filter['TENLOAISP'][$i]; ?></a></li>
				 <?php 				 
				 	}
				  ?>								
			</ul>
			<div class="row">
				<?php 				
					for($i = 0;$i<count($bestsell['IDSANPHAM']);++$i){						
				 ?>
				 <div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
							<img src="../images/<?php echo $bestsell['HINH'][$i]; ?>" alt="" style="height: 300px;">
							<div class="pi-links">
								<a style="cursor: pointer;" class="add-card" value="<?php echo $bestsell['IDSANPHAM'][$i]; ?>"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								
							</div>
						</div>
						<div class="pi-text">
							<h6><?php echo $bestsell['DONGIA'][$i]; ?></h6>
							<p><a href="product.php?id=<?php echo $bestsell['IDSANPHAM'][$i]; ?>"><?php echo $bestsell['TENSANPHAM'][$i]; ?></a></p>
						</div>
					</div>
				</div>	
				 <?php 
				 	}
				  ?>							
			</div>
			<div class="text-center pt-5">
				<button class="site-btn sb-line sb-dark" onclick="window.location.href = 'category.php';">XEM THÊM</button>
			</div>
		</div>
	</section>
	<!-- Product filter section end -->


	<!-- Banner section -->
	<section class="banner-section">
		<div class="container">
			<div class="banner set-bg" data-setbg="img/banner-bg.jpg">
				<div class="tag-new">NEW</div>
				<span>SẢN PHẨM MỚI NHẬP</span>
				<h2>GIÀY THỂ THAO</h2>
				<a href="category.php" class="site-btn">XEM NGAY</a>
			</div>
		</div>
	</section>
	<!-- Banner section end  -->


<?php include_once('footer.php'); ?>
