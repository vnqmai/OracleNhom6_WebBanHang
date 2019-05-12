<?php 
	include_once '../libs/database.php';
	$id = $_REQUEST['id'];	
	$sql = 'SELECT * FROM HOADON WHERE TAIKHOAN = '.$id.' ORDER BY IDHOADON DESC';
	$listbill = db_get_list($sql);	
 ?>
<?php include_once 'header.php'; ?>
<div class="container">
	<div class="row">
		<?php 			
			for($i = 0;$i<count($listbill['IDHOADON']);++$i){
				$sum = 0;
		 ?>
		<div class="cart-table col-lg-12">
			<h3>Hóa đơn số <?php echo $listbill['IDHOADON'][$i]; ?> (<?php echo $listbill['TRANGTHAI'][$i]; ?>)</h3>			
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
			<?php
				$sql = "SELECT * FROM CHITIETHOADON CT, SANPHAM SP WHERE CT.HOADON = ".$listbill['IDHOADON'][$i]." AND CT.SANPHAM = SP.IDSANPHAM";
				$listbillitem = db_get_list($sql);
				for ($j=0; $j < count($listbillitem['IDCHITIETHD']); $j++) { 
					$sum+=$listbillitem['THANHTIEN'][$j];
			 ?>	
			 <tr>
			 	<td class="product-col">
			 		<img src="../images/<?php echo $listbillitem['HINH'][$j]; ?>" alt="">
			 		<div class="pc-title">
			 			<h4><?php echo $listbillitem['TENSANPHAM'][$j]; ?></h4>
			 			<p><?php echo $listbillitem['DONGIA'][$j]; ?></p>
			 		</div>
			 	</td>
			 	<td class="quy-col">
			 		<div class="quantity">
			 			<div class="pro-qty">
			 				<input type="text" value="<?php echo $listbillitem['SOLUONG'][$j]; ?>" readonly='true'>
			 			</div>
			 		</div>
			 	</td>
			 	<td class="total-col">
			 		<h4><?php echo $listbillitem['THANHTIEN'][$j]; ?></h4>
			 	</td>	 				
			 <?php 			 				 	
				 } 
			 ?>			
			 </tbody>
			</table>
			</div>
			<div class="total-cost">
				<h6>Tổng bill <span id="total"><?php echo $sum; ?></span></h6>
			</div>
		</div>
		<?php 
			}
		 ?>
	</div>
</div>
<?php include_once 'footer.php'; ?>