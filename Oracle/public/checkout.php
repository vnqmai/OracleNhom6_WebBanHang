<?php include_once 'header.php'; ?>
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Thanh toán</h4>
			<div class="site-pagination">
				<a href="">Home</a> /
				<a href="">Checkout</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- checkout section  -->
	<section class="checkout-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 order-2 order-lg-1">
					<form class="checkout-form">
						<div class="cf-title">Thông tin hóa đơn</div>
						<div class="row">
							<div class="col-md-7">
								<p>Hóa đơn</p>
							</div>							
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								<input type="text" placeholder="Họ tên">
								<input type="text" placeholder="Địa chỉ">
								<input type="text" placeholder="Số điện thoại">
								<input type="text" placeholder="Email">
							</div>														
						</div>
						<button class="site-btn submit-order-btn">Thanh toán</button>
					</form>
				</div>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="checkout-cart">
						<h3>Giỏ hàng</h3>
						<ul class="product-list" id="res">
							<!-- <li>
								<div class="pl-thumb"><img src="img/cart/1.jpg" alt=""></div>
								<h6>Animal Print Dress</h6>
								<p>$45.90</p>
							</li>
							<li>
								<div class="pl-thumb"><img src="img/cart/2.jpg" alt=""></div>
								<h6>Animal Print Dress</h6>
								<p>$45.90</p>
							</li> -->
						</ul>
						<ul class="price-list">														
							<li class="total">Total<span id="total"></span></li>
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
		for(var i = 0;i<listitem.length;++i){
			element += '<li><div class="pl-thumb"><img src="../images/'+listitem[i].hinh+'" alt=""></div><h6>'+listitem[i].ten+'</h6><p>'+listitem[i].soluong*listitem[i].dongia+'</p></li>'			
			total+= listitem[i].soluong*listitem[i].dongia;
		}
		$('#res').html(element);
		$('#total').text(total);
	});
</script>