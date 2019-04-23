<?php 
	if(!is_admin()){
		redirect(base_url("admin"),array('m' => 'common', 'a' => 'logout'));
	}
	include_once "database/product.php";
	$id = input_get('idsp');
	if(!empty($id)){
		$sanpham = get_SP_by_ID($id);
	}
	if(is_submit("editproduct")){
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
		
		$filename = uploadfile($file);			
		$filehoverstring = uploadfiles($files);

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
			if($filename != 'File lỗi.' && gettype($filehoverstring)=='string'){				
				echo update_SP_by_ID($id,$tensp,$filename,$dongia,$mota,$filehoverstring,$loaisp,$soluongcon,$soluongdaban,$gioitinh,$thuonghieu);
			}			
		}
	}
 ?>
 <?php 
 	$listloai = db_get_list("SELECT IDLOAISP, TENLOAISP FROM LOAISANPHAM");
 	$listthuonghieu = db_get_list("SELECT IDTHUONGHIEU, TENTHUONGHIEU FROM THUONGHIEU"); 	
  ?>
  <?php 
	include_once "widgets/header.php";
 ?>
  <div class="col-md-8 col-md-push-2 col-md-pull-2">
  	<form action="<?php echo '?m=product&a=edit&idsp='.$id; ?>" method="POST" role="form" enctype="multipart/form-data">
	  	<legend>Thêm sản phẩm</legend>
	  
	  	<div class="form-group">
	  		<label for="TENSP">Tên sản phẩm</label>
	  		<input type="text" class="form-control" name="tensp" id="tensp" value="<?php echo $sanpham['TENSANPHAM'][0]; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('editproduct')){
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
	  	</div>	  
	  	<div class="form-group">
	  		<label for="DONGIA">Đơn giá</label>
	  		<input type="number" class="form-control" name="dongia" id="dongia" value="<?php echo $sanpham['DONGIA'][0]; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('editproduct')){
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
	  		<textarea class="form-control" name="mota" id="mota"><?php echo $sanpham['MOTA'][0]; ?></textarea>
	  		<span class="error">
	  			<?php 
	  				if(is_submit('editproduct')){
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
	  					if($listloai['IDLOAISP'][$i] == $sanpham['IDLOAISP'][0])
	  						echo "<option value='".$listloai['IDLOAISP'][$i]."' selected>".$listloai['TENLOAISP'][$i]."</option>";
	  					echo "<option value='".$listloai['IDLOAISP'][$i]."'>".$listloai['TENLOAISP'][$i]."</option>";
	  				}	  			
	  			 ?>
	  		</select>
	  	</div>
	  	<div class="form-group">
	  		<label for="SOLUONGCON">Số lượng còn</label>
	  		<input type="number" class="form-control" name="soluongcon" id="soluongcon" value="<?php echo $sanpham['SOLUONGCON'][0]; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('editproduct')){
	  					if(!empty($error['soluongcon'])){
	  						echo $error['soluongcon'];
	  					}
	  				}
	  			 ?>
	  		</span>
	  	</div>
	  	<div class="form-group">
	  		<label for="SOLUONGDABAN">Số lượng đã bán</label>
	  		<input type="number" class="form-control" name="soluongdaban" id="soluongdaban"  value="<?php echo $sanpham['SOLUONGDABAN'][0]; ?>">
	  		<span class="error">
	  			<?php 
	  				if(is_submit('editproduct')){
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
	  			<?php 
	  				if($sanpham['GIOITINH']=='Nữ'){
	  					echo '<option value="Nam">Nam</option><option value="Nữ" selected>Nữ</option>';
	  				}
	  				else
	  					echo '<option value="Nam" selected>Nam</option><option value="Nữ">Nữ</option>';
	  			 ?>	  			
	  		</select>
	  	</div>
	  	<div class="form-group">
	  		<label for="THUONGHIEU">Thương hiệu</label>
	  		<select name="thuonghieu" id="thuonghieu" class="form-control" required="required">
	  			<?php 
	  				$n = count($listthuonghieu['IDTHUONGHIEU']);
	  				for($i = 0;$i<$n;++$i){
	  					if($listthuonghieu['IDTHUONGHIEU'][$i] == $sanpham['IDTHUONGHIEU'][0])
	  						echo "<option value='".$listthuonghieu['IDTHUONGHIEU'][$i]."' selected>".$listthuonghieu['TENTHUONGHIEU'][$i]."</option>";
	  					echo "<option value='".$listthuonghieu['IDTHUONGHIEU'][$i]."'>".$listthuonghieu['TENTHUONGHIEU'][$i]."</option>";
	  				}
	  			 ?>
	  		</select>
	  	</div>
		<input type="hidden" name="request" value="editproduct">	  
	  	<button type="submit" class="btn btn-primary">Sửa</button>
	  </form>
  </div>

<?php 
	include_once "widgets/footer.php";
 ?>