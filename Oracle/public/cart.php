<?php include_once 'header.php'; ?>
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Giỏ hàng</h4>
			<div class="site-pagination">
				<a href="">Home</a> /
				<a href="">Cart</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart-table">
						<h3>Giỏ hàng</h3>
						<div class="cart-table-warp">
							<table>
							<thead>
								<tr>
									<th class="product-th">Sản phẩm</th>
									<th class="quy-th">Số lượng</th>									
									<th class="total-th">Giá</th>
								</tr>
							</thead>
							<tbody id="res">						
							</tbody>
						</table>
						</div>
						<div class="total-cost">
							<h6>Tổng bill <span id="total"></span></h6>
						</div>
					</div>
				</div>
				<div class="col-lg-4 card-right">					
					<a href="checkout.php" class="site-btn">Thanh toán</a>
					<a href="" class="site-btn sb-dark">Tiếp tục mua sắm</a>
				</div>
			</div>
		</div>
	</section>
	<!-- cart section end -->
	



<?php include_once 'footer.php'; ?>

<script type="text/javascript">
	$(document).ready(function(){	
	// sessionStorage.clear();			
		cart = sessionStorage.getItem("cart");
		listitem = jQuery.parseJSON(cart);
		element=""; total = 0;
		for(var i = 0;i<listitem.length;++i){
			element += '<tr><td class="product-col"><img src="../images/'+listitem[i].hinh+'" alt=""><div class="pc-title"><h4>'+listitem[i].ten+'</h4><p>'+listitem[i].dongia+'</p></div></td><td class="quy-col"><div class="quantity"><div class="pro-qty"><input type="text" value="'+listitem[i].soluong+'"></div></div></td><td class="total-col"><h4>'+listitem[i].soluong*listitem[i].dongia+'</h4></td></tr>';		
			total+= listitem[i].soluong*listitem[i].dongia;
		}
		$('#res').html(element);
		$('#total').text(total);
	});
</script>