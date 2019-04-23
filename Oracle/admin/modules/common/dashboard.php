<?php if (!defined('IN_SITE')) die ('The request not found'); ?>
<?php include_once('widgets/header.php'); ?>

<div class="col-md-10 col-md-push-1 col-md-pull-1">
	<div role="tabpanel">
	<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#home" aria-controls="home" role="tab" data-toggle="tab">Dashboard</a>
			</li>
			<li role="presentation">
				<a href="#qlsanpham" aria-controls="tab" role="tab" data-toggle="tab">Quản lý sản phẩm</a>
			</li>
			<li role="presentation">
				<a href="#qlhoadon" aria-controls="tab" role="tab" data-toggle="tab">Quản lý hóa đơn</a>
			</li>
			<li role="presentation">
				<a href="#qltaikhoan" aria-controls="tab" role="tab" data-toggle="tab">Quản lý tài khoản</a>
			</li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
				<?php include_once "modules/chart/ProductViewChart.php"; ?>
			</div>
			<div role="tabpanel" class="tab-pane" id="qlsanpham">
				<?php include_once ("modules/product/list.php"); ?>				
			</div>
			<div role="tabpanel" class="tab-pane" id="qlhoadon">
				<h3>Danh sách hóa đơn</h3>
			</div>
			<div role="tabpanel" class="tab-pane" id="qltaikhoan">
				<h3>Danh sách tài khoản</h3>
			</div>			
		</div>
	</div>
</div>

<?php include_once('widgets/footer.php'); ?>
