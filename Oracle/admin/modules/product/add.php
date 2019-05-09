<?php 
	if (!is_admin()){
        redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
    }
 ?>

 <?php 
 	$listloai = db_get_list("SELECT IDLOAISP, TENLOAISP FROM LOAISANPHAM");
 	$listthuonghieu = db_get_list("SELECT IDTHUONGHIEU, TENTHUONGHIEU FROM THUONGHIEU"); 	
  ?>
<?php 
	include_once "database/product.php";
	if(is_submit('addproduct')){	
		$error = "";	
		$tensp = input_post('tensp');		
		$file = input_file('hinh');		
		$dongia = input_post('dongia');
		$mota = input_post('mota');
		$files = input_file('hovergallery');
		$loaisp = input_post('loaisp');
		$soluongcon = input_post('soluongcon');
		$soluongdaban = input_post('soluongdaban');
		$gioitinh = input_post('gioitinh');
		$thuonghieu = input_post('thuonghieu');
		if(empty($tensp)){
			$error['tensp'] = 'Bạn chưa nhập tên sản phẩm.';
		}
		if(empty($file)){
			$error['hinh'] = 'Bạn chưa chọn hình ảnh.';
		}
		if(empty($files)){
			$error['hovergallery'] = 'Bạn chưa chọn hình ảnh.';
		}		
		if(empty($soluongcon)){
			$error['soluongcon'] = 'Bạn chưa nhập số lượng sản phẩm.';
		}
		if(empty($soluongdaban)){
			$error['soluongdaban'] = 'Bạn chưa nhập số lượng đã bán.';
		}
		if(empty($dongia)){
			$error['dongia'] = 'Bạn chưa nhập đơn giá sản phẩm.';
		}			

		if(!$error){
			$filename = uploadfile($file);			
			$filehoverstring = uploadfiles($files);
			if($filename!='File lỗi' && gettype($filehoverstring)!='array'){
				echo insert_SP($tensp,$filename,$dongia,$mota,$filehoverstring,$loaisp,$soluongcon,$soluongdaban,$gioitinh,$thuonghieu);
			}
		}		
	}
 ?>
<?php 
	include_once "widgets/header.php";
 ?>
  <div class="col-md-8 col-md-push-2 col-md-pull-2">
  	<form action="?m=product&a=add" method="POST" role="form" enctype="multipart/form-data">
	  	<legend>Thêm sản phẩm</legend>
	  
	  	<div class="form-group">
	  		<label for="TENSP">Tên sản phẩm</label>
	  		<input type="text" class="form-control" name="tensp" id="tensp">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('addproduct')){
	  					if(!empty($error['tensp'])){
	  						echo $error['tensp'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
		<div class="form-group">
	  		<label for="HINH">Hình ảnh chính</label>
	  		<input type="file" class="form-control" name="hinh" id="hinh">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('addproduct')){
	  					if(!empty($error['hinh'])){
	  						echo $error['hinh'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>	  
	  	<div class="form-group">
	  		<label for="DONGIA">Đơn giá</label>
	  		<input type="number" class="form-control" name="dongia" id="dongia">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('addproduct')){
	  					if(!empty($error['dongia'])){
	  						echo $error['dongia'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	<div class="form-group">
	  		<label for="MOTA">Mô tả</label>
	  		<!-- <input type="te" class="form-control" name="dongia" id="dongia"> -->
	  		<textarea class="form-control" name="mota" id="mota"></textarea>
	  		<span class="error">
	  			<?php 
	  				if(is_submit('addproduct')){
	  					if(!empty($error['mota'])){
	  						echo $error['mota'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>	  
	  	<div class="form-group">
	  		<label for="HOVERGALLERY">Hình ảnh chi tiết</label>
	  		<input type="file" class="form-control" name="hovergallery[]" id="hovergallery" multiple="4">
	  	</div>
	  	<div class="form-group">
	  		<label for="LOAISP">Loại sản phẩm</label>	  		
	  		<select name="loaisp" id="loaisp" class="form-control" required="required">	  			
	  			<?php 
	  				$n = count($listloai['IDLOAISP']);
	  				for ($i = 0; $i < $n;++$i) {
	  					echo "<option value='".$listloai['IDLOAISP'][$i]."'>".$listloai['TENLOAISP'][$i]."</option>";
	  				}	  			
	  			 ?>
	  		</select>
	  	</div>
	  	<div class="form-group">
	  		<label for="SOLUONGCON">Số lượng còn</label>
	  		<input type="number" class="form-control" name="soluongcon" id="soluongcon">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('addproduct')){
	  					if(!empty($error['soluongcon'])){
	  						echo $error['soluongcon'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	<div class="form-group">
	  		<label for="SOLUONGDABAN">Số lượng đã bán</label>
	  		<input type="number" class="form-control" name="soluongdaban" id="soluongdaban" value="0">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('addproduct')){
	  					if(!empty($error['soluongdaban'])){
	  						echo $error['soluongdaban'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	<div class="form-group">
	  		<label for="GIOITINH">Dành cho</label>
	  		<select name="gioitinh" id="gioitinh" class="form-control" required="required">
	  			<option value="Nam">Nam</option>
	  			<option value="Nữ">Nữ</option>
	  		</select>
	  	</div>
	  	<div class="form-group">
	  		<label for="THUONGHIEU">Thương hiệu</label>
	  		<select name="thuonghieu" id="thuonghieu" class="form-control" required="required">
	  			<?php 
	  				$n = count($listthuonghieu['IDTHUONGHIEU']);
	  				for($i = 0;$i<$n;++$i){
	  					echo "<option value='".$listthuonghieu['IDTHUONGHIEU'][$i]."'>".$listthuonghieu['TENTHUONGHIEU'][$i]."</option>";
	  				}
	  			 ?>
	  		</select>
	  	</div>
		<input type="hidden" name="request" value="addproduct">	  
	  	<button type="submit" class="btn btn-primary">Thêm</button>
	  </form>
  </div>

<?php 
	include_once "widgets/footer.php";
 ?>

 <style type="text/css">
 	.error{color: red;}
 </style>