<?php include_once 'header.php'; ?>
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Thanh toán</h4>
			<div class="site-pagination">
				<a href="">Trang chủ</a> /
				<a href="">Thanh toán</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- checkout section  -->
	<section class="checkout-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 order-2 order-lg-1">
					<?php 
						// session_start();
						include_once '../libs/database.php';
						if(isset($_SESSION['username'])){
							$username = $_SESSION['username'];
							$sql = "SELECT * FROM TAIKHOAN WHERE TENDN = '".$username."'";
							$user = db_get_list($sql);
					?>					
					<form class="checkout-form">
						<div class="cf-title">Thông tin hóa đơn</div>
						<div class="row">
							<div class="col-md-7">
								<p>Hóa đơn</p>
							</div>							
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								<input type="text" placeholder="Họ tên" value="<?php echo($user['HOTEN'][0]); ?>" readonly="true">
								<input type="text" placeholder="Địa chỉ" value="<?php echo($user['DIACHI'][0]); ?>" readonly="true">
								<input type="text" placeholder="Số điện thoại" value="<?php echo($user['SODIENTHOAI'][0]); ?>" readonly="true">
								<input type="text" placeholder="Email" value="<?php echo($user['EMAIL'][0]); ?>" readonly="true">
							</div>														
						</div>						
					</form>
					<button class="site-btn submit-order-btn" name="checkout" id="checkout">Thanh toán</button>
					<div style="text-align: center;" id="ress"></div>
					<?php							
						}
						else{
					?>
					<div class="cf-title">Bạn chưa đăng nhập. <a href="signin.php">Đăng nhập.</a></div>
					<?php
						}
					 ?>
				</div>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="checkout-cart">
						<h3>Giỏ hàng</h3>
						<ul class="product-list" id="res">

						</ul>
						<ul class="price-list">														
							<li class="total">Tổng bill<span id="total"></span></li>
						</ul>
					</div>
				</div>
			</div>			
		</div>
		
	</section>
	<!-- checkout section end -->

<?php include_once 'footer.php'; ?>

<script type="text/javascript">
	$(document).ready(function(){
		cart = sessionStorage.getItem("cart");
		listitem = jQuery.parseJSON(cart);
		element=""; total = 0;
		if(listitem==null){
			$('#total').text('0');
		}
		else{
			for(var i = 0;i<listitem.length;++i){
				element += '<li><div class="pl-thumb"><img src="../images/'+listitem[i].hinh+'" alt=""></div><h6>'+listitem[i].ten+'</h6><p>'+listitem[i].soluong*listitem[i].dongia+'</p></li>';			
				total+= listitem[i].soluong*listitem[i].dongia;
			}
			$('#res').html(element);
			$('#total').text(total);
		}		

		$('#checkout').click(function(){
			$.ajax({
				type: 'POST',
				url: 'ajax/checkout.php',
				data: {data: sessionStorage.getItem('cart')},
				success: function(response){
					sessionStorage.clear();
					$('#ress').html(response);					
				}
			});
		});
	});
</script>