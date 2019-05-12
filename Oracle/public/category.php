<?php 
	include_once('../libs/database.php');
	$sql = 'SELECT * FROM LOAISANPHAM';
	$filter = db_get_list($sql);
	$sql = 'SELECT IDTHUONGHIEU, TENTHUONGHIEU, COUNT(T.TENTHUONGHIEU) AS "COUNTER" FROM THUONGHIEU T, SANPHAM S WHERE T.IDTHUONGHIEU = S.THUONGHIEU GROUP BY TENTHUONGHIEU, IDTHUONGHIEU';
	$brand = db_get_list($sql);

	$listsp = "";
	if(isset($_REQUEST['id'])){
		$id = $_REQUEST['id'];
	}	
	if(empty($id))
		$id = 0;
	if($id == 0){
		$sql = 'SELECT * FROM SANPHAM';
		$listsp = db_get_list($sql);
	}	
	else{
		$sql = 'SELECT * FROM SANPHAM WHERE IDSANPHAM = '.$id;
		$listsp = db_get_list($sql);
	}

 ?>
<?php include_once 'header.php'; ?>
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Sản phẩm</h4>
			<div class="site-pagination">
				<a href="">Trang chủ</a> /
				<a href="">Sản phẩm</a> /
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- Category section -->
	<section class="category-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 order-2 order-lg-1">
					<div class="filter-widget">
						<h2 class="fw-title">Danh mục loại sản phẩm</h2>
						<ul class="category-menu" id="category-filter">
							<li><a style="cursor: pointer;" class="gender" value="Nữ">Dành cho nữ</a></li>
							<li><a style="cursor: pointer;" class="gender" value="Nam">Dành cho nam</a></li>
							<?php 
								for($i = 0;$i<count($filter['IDLOAISP']);++$i){
							?>
							<!-- category.php?filter=<?php //echo($filter['IDLOAISP'][0]); ?> -->
							<li><a value="<?php echo $filter['IDLOAISP'][$i];?>" style="cursor: pointer;"><?php echo $filter['TENLOAISP'][$i]; ?></a></li>
							<?php
								}
							 ?>
						</ul>
					</div>
					<div class="filter-widget mb-0">
						<h2 class="fw-title">Lọc theo</h2>
						<div class="price-range-wrap">
							<h4>Đơn giá</h4>
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="0" data-max="30000000">
								<div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div>
								<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;">
								</span>
								<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;">
								</span>
							</div>
							<div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
					</div>					
					<div class="filter-widget">
						<h2 class="fw-title">Thương hiệu</h2>
						<ul class="category-menu" id="brand-filter">
							<?php 
								for($i = 0;$i<count($brand['COUNTER']);++$i){
							?>
							<li><a value="<?php echo $brand['IDTHUONGHIEU'][$i]; ?>" style="cursor: pointer;"><?php echo $brand['TENTHUONGHIEU'][$i]; ?> <span>(<?php echo $brand['COUNTER'][$i]; ?>)</span></a></li>
							<?php
								}
							 ?>							
						</ul>
					</div>
				</div>

				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<div class="row" id="res">
						<?php 
							for($i = 0 ;$i<count($listsp['IDSANPHAM']);++$i){
						?>						
						<div class="col-lg-4 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">									
									<img src="../images/<?php echo $listsp['HINH'][$i]; ?>" alt="" style="height: 250px;">
									<div class="pi-links">
										<a style="cursor: pointer;" class="add-card" value="<?php echo $listsp['IDSANPHAM'][$i]; ?>"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>										
									</div>
								</div>
								<div class="pi-text">
									<h6><?php echo $listsp['DONGIA'][$i]; ?></h6>
									<p><a href="product.php?id=<?php echo $listsp['IDSANPHAM'][$i]; ?>"><?php echo $listsp['TENSANPHAM'][$i]; ?></a></p>
								</div>
							</div>
						</div>
						<?php
							}
						 ?>
						<div class="text-center w-100 pt-3">
							<button class="site-btn sb-line sb-dark">XEM THÊM</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Category section end -->
<?php include_once 'footer.php'; ?>

<script type="text/javascript">
	$('#category-filter').find($('li')).find($('a')).click(function(){
		$.ajax({
			type: 'POST',
			url: 'ajax/filter.php',			
			data: {'category':$(this).attr('value')},
			success: function(response){
				$('#res').html(response);
			}
		});
	});	
	$('.gender').click(function(){
		$.ajax({
			type: 'POST',
			url: 'ajax/filter.php',			
			data: {'gender':$(this).attr('value')},
			success: function(response){
				$('#res').html(response);
			}
		});
	});	
	$('#brand-filter').find($('li')).find($('a')).click(function(){
		$.ajax({
			type: 'POST',
			url: 'ajax/filter.php',			
			data: {'brand':$(this).attr('value')},
			success: function(response){
				$('#res').html(response);
			}
		});
	});	
	
</script>

