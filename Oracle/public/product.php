<?php 
	include_once '../libs/database.php';
	$id = $_REQUEST['id'];
	$sql = 'SELECT * FROM SANPHAM WHERE IDSANPHAM = '.$id;
	$sp = db_get_list($sql);
	$ten = $sp['TENSANPHAM'][0];
	$hinh = $sp['HINH'][0];
	$gia = $sp['DONGIA'][0];
	$mota = $sp['MOTA'][0];
	$hovergallery = $sp['HOVERGALLERY'][0];
	$hover = explode('*',$hovergallery);	
	$slcon = $sp['SOLUONGCON'][0];
 ?>
<?php include_once 'header.php'; ?>
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Chi tiết sản phẩm</h4>
			<div class="site-pagination">
				<a href="">Home</a> /
				<a href="">Single page</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- product section -->
	<section class="product-section">
		<div class="container">
			<div class="back-link">
				<a href="./category.html"> &lt;&lt; Trở về</a>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="product-pic-zoom">
						<img class="product-big-img" src="../images/<?php echo $hinh; ?>" alt="">
					</div>
					<div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
						<div class="product-thumbs-track">
							<div class="pt active" data-imgbigurl="../images/<?php echo($hover[0]); ?>"><img src="../images/<?php echo($hover[0]); ?>" alt=""></div>
							<div class="pt" data-imgbigurl="../images/<?php echo($hover[1]); ?>"><img src="../images/<?php echo($hover[1]); ?>" alt=""></div>
							<div class="pt" data-imgbigurl="../images/<?php echo($hover[2]); ?>"><img src="../images/<?php echo($hover[2]); ?>" alt=""></div>
							<div class="pt" data-imgbigurl="../images/<?php echo($hover[3]); ?>"><img src="../images/<?php echo($hover[3]); ?>" alt=""></div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 product-details">
					<h2 class="p-title"><?php echo $ten; ?></h2>
					<h3 class="p-price"><?php echo $gia; ?></h3>	
					<h4 class="p-stock">Tình trạng: <span><?php if($slcon>0) echo "Còn hàng"; else echo "Hết hàng"; ?></span></h4>	
					<?php if($slcon>0){ ?>
					<div class="quantity">
						<p>Số lượng</p>
                        <div class="pro-qty"><input type="text" value="1"></div>
                    </div>                    
					<a style="cursor: pointer;" class="site-btn" id="add-card" value="<?php echo $id; ?>">MUA NGAY</a>
					<?php } ?>
					<div id="accordion" class="accordion-area">
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">Mô tả</button>
							</div>
							<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
									<p><?php echo $mota; ?></p>
								</div>
							</div>
						</div>											
					</div>					
				</div>
			</div>
		</div>
	</section>
	<!-- product section end -->


	<?php include_once 'footer.php'; ?>
	<script type="text/javascript">
		$('.site-btn').click(function(){		
			id = $(this).attr('value');
			hinh = $('.product-big-img').attr('src');
			ten = $('.p-title').text();
			dongia = $('.p-price').text();
			sl = $('.pro-qty').find('input').val();		
			cart = sessionStorage.getItem('cart');
			listitem = jQuery.parseJSON(cart);
			if(cart == null){
				sessionStorage.setItem("cart", '[{"id":'+id+', "hinh":"'+hinh+'", "ten": "'+ten+'", "dongia": '+dongia+', "soluong":'+sl+'}]');
			}
			else{				
				dem = 0;
				
				for(var i = 0;i<listitem.length;++i){
					if(listitem[i].id==id){
						listitem[i].soluong = parseInt(listitem[i].soluong) + parseInt(sl);
						++dem;						
					}
				}
				if(dem==0){
					var newitem = jQuery.parseJSON('{"id":'+id+', "hinh":"'+hinh+'", "ten": "'+ten+'", "dongia": '+dongia+', "soluong":'+sl+'}');					
					listitem.push(newitem);				
				}
				sessionStorage.setItem("cart", JSON.stringify(listitem));
			}	
			$('.shopping-card').find('span').text(listitem.length);					
			$( "#dialog-confirm" ).dialog({		
		      resizable: false,
		      height: "auto",
		      width: 400,
		      modal: true,
		      buttons: {
		        "Xem giỏ hàng": function() {
		          window.location.href = 'checkout.php';
		        },
		        "Đóng": function() {
		          $( this ).dialog( "close" );
		        }
		      }	      
		    });
		    $('#dialog-confirm').find('p').css('display','block');
		});
	</script>