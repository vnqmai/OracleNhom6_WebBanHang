<?php if (!defined('IN_SITE')) die ('The request not found');
	function insert_SP($tensp, $filename, $dongia, $mota,$hovergalstring, $loaisp, $slcon, $sldaban, $gioitinh, $thuonghieu){
		return execute("INSERT INTO SANPHAM VALUES ((select max(IDSANPHAM)+1 from SANPHAM),N'".$tensp."','".$filename."',".floatval($dongia).",N'".$mota."','".$hovergalstring."',".intval($loaisp).",".intval($slcon).",".intval($sldaban).",N'".$gioitinh."',".intval($thuonghieu).")");
	}
	function delete_SP_by_ID($id){
		return execute("DELETE SANPHAM WHERE IDSANPHAM = ".$id);
	}
	function get_SP_by_ID($id){
		return db_get_row("SELECT * FROM SANPHAM WHERE IDSANPHAM =".$id);
	}
	function update_SP_by_ID($id,$tensp, $filename, $dongia, $mota,$hovergalstring, $loaisp, $slcon, $sldaban, $gioitinh, $thuonghieu){
		return execute("UPDATE SANPHAM SET TENSANPHAM = N'{$tensp}', HINH = '{$filename}', DONGIA = {$dongia}, MOTA = N'{$mota}', HOVERGALLERY = '{$hovergalstring}',LOAISP = {$loaisp}, SOLUONGCON = {$slcon}, SOLUONGDABAN = {$sldaban}, GIOITINH = N'{$gioitinh}', THUONGHIEU = {$thuonghieu} WHERE IDSANPHAM = {$id}");
	}
?>