<!-- BEGIN FILTER WITH CATEGORY -->
<?php 
	include_once('../../libs/database.php');
	if(isset($_POST['category'])){
		$sql = 'SELECT * FROM SANPHAM WHERE LOAISP = '.intval($_POST['category']);
		$list = db_get_list($sql);		
	}
	else if(isset($_POST['gender'])){
		$sql = "SELECT * FROM SANPHAM WHERE GIOITINH = N'".$_POST['gender']."'";		
		$list = db_get_list($sql);
	}
	else if(isset($_POST['brand'])){
		$sql = "SELECT * FROM SANPHAM WHERE THUONGHIEU = ".$_POST['brand'];		
		$list = db_get_list($sql);	
	}
	for($i = 0;$i<count($list['IDSANPHAM']);++$i){		
?>
<div class="col-lg-4 col-sm-6">
	 <div class="product-item">
		<div class="pi-pic">									
			<img src="../images/<?php echo($list['HINH'][$i]); ?>" alt="" style="height: 250px;">
			<div class="pi-links">
				<a href="#" class="add-card" value="<?php echo $list['IDSANPHAM'][$i]; ?>"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>				
			</div>
		</div>
		<div class="pi-text">
			<h6><?php echo($list['DONGIA'][$i]); ?></h6>
			<p><a href="product.php?id=<?php echo $list['IDSANPHAM'][$i]; ?>" class="confirmLink"><?php echo($list['TENSANPHAM'][$i]); ?></a></p>
		</div>
	</div>
</div>
<?php		
	}
?>
<!-- END FILTER WITH CATEGORY -->

<script src="js/cart.js"></script>
