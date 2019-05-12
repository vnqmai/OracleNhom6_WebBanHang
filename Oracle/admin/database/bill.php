<?php if (!defined('IN_SITE')) die ('The request not found');



	function insert_HD($ngaylap, $trangthai, $taikhoan){

		$ngaylap = changeDate($ngaylap);

		//echo "INSERT INTO HOADON VALUES ((select max(IDHOADON)+1 from HOADON),'".$ngaylap."',N'".$trangthai."',".intval($taikhoan).")";
		return execute("INSERT INTO HOADON VALUES ((select max(IDHOADON)+1 from HOADON),'".$ngaylap."',N'".$trangthai."',".intval($taikhoan).")");
	}
	function insert_CTHD( $sanpham,$soluong, $thanhtien){

		//echo "INSERT INTO CHITIETHOADON VALUES ((select max(IDCHITIETHD)+1 from CHITIETHOADON),".intval($sanpham).",".intval($soluong).",".floatval($thanhtien).",(select max(IDHOADON) from HOADON))";
		return execute("INSERT INTO CHITIETHOADON VALUES ((select max(IDCHITIETHD)+1 from CHITIETHOADON),".intval($sanpham).",".intval($soluong).",".floatval($thanhtien).",(select max(IDHOADON) from HOADON))");
	}
	function delete_BIL_by_ID($id){
		return execute("DELETE HOADON WHERE IDHOADON = ".$id);
	}
	/*function get_BIL_by_ID($id){
		return db_get_row("SELECT * FROM HOADON HD, CHITIETHOADON CT WHERE HD.IDHOADON=CT.HOADON AND CT.IDCHITIETHD=".$id);
	}*/
        function get_DETAIL_BIL_by_ID($id){
                return db_get_row("SELECT * FROM HOADON HD, CHITIETHOADON CT, SANPHAM SP WHERE HD.IDHOADON=CT.HOADON AND SP.IDSANPHAM=CT.SANPHAM AND HD.IDHOADON=".$id);
        }

        //Hàm update trạng thái
	function update_BIL_by_ID($idhd,$trangthai){
                //echo "UPDATE HOADON SET TRANGTHAI = N'{$trangthai}' WHERE IDHOADON = {$idhd}";
                //execute("SELECT * FROM HOADON FOR UPDATE NOWAIT");
		return execute("UPDATE HOADON SET TRANGTHAI = N'{$trangthai}' WHERE IDHOADON = {$idhd}");
                //return execute("UPDATE HOADON SET TRANGTHAI = N'{$trangthai}' WHERE IDHOADON = {$idhd}");
	}
        function update_BIL_DETAIL_by_ID($id,$idhd,$sanpham,$soluong,$thanhtien){
                //return execute("UPDATE SANPHAM SET TENSANPHAM = N'{$tensp}', HINH = '{$filename}', DONGIA = {$dongia}, MOTA = N'{$mota}', HOVERGALLERY = '{$hovergalstring}',LOAISP = {$loaisp}, SOLUONGCON = {$slcon}, SOLUONGDABAN = {$sldaban}, GIOITINH = N'{$gioitinh}', THUONGHIEU = {$thuonghieu} WHERE IDSANPHAM = {$id}");
                //echo "UPDATE CHITIETHOADON SET SANPHAM = {$sanpham}, SOLUONG = {$soluong}, THANHTIEN = {$thanhtien}, HOADON = {$idhd}  WHERE IDCHITIETHD = {$id}";
                //execute("SELECT * FROM CHITIETHOADON FOR UPDATE NOWAIT");
                //return execute("UPDATE CHITIETHOADON SET SANPHAM = {$sanpham}, SOLUONG = {$soluong}, THANHTIEN = {$thanhtien}, HOADON = {$idhd}  WHERE IDCHITIETHD = {$id}");
        }




        //hàm chuyển ngày từ 2019-05-01 thành 01-MAY-2019

        function changeDate($date) {
                $date = preg_split("/[\/]|[-]+/", $date);
        if($date[1]=='01'){
                $date[1]='JAN';
        }
        
        elseif($date[1]=='02'){
                $date[1]='FER';
        }
        elseif($date[1]=='03'){
                $date[1]='MAR';
        }
        elseif($date[1]=='04'){
                $date[1]='APR';
        }
        elseif($date[1] =='05'){
                $date[1]='MAY';
        }
        elseif($date[1]=='06'){
                $date[1]='JUN';
        }
        elseif($date[1]=='07'){
                $date[1]='JUL';
        }
        elseif($date[1]=='08'){
                $date[1]='AUG';
        }
        elseif($date[1]=='09'){
                $date[1]='SEP';
        }
        elseif($date[1]=='10'){
                $date[1]='OCT';
        }
        elseif($date[1]=='11'){
                $date[1]='NOV';
        }
        elseif($date[1]=='12'){
                $date[1]='DEC';
        }
                $date = $date[2]."-".$date[1]."-".$date[0];
        return $date;
        }
?>