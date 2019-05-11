 
<?php 

    if (!is_admin()){
        redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
    }


    include "database/bill.php";
    //Lấy chi tiết hóa đơn
    $id = input_get('idhd');
    if(!empty($id)){
        $bills = get_DETAIL_BIL_by_ID($id);
    }


    //Thay đổi trạng thái


    if(is_submit("editTrangthai")){
        
        $error = "";    
        $trangthai1= input_post('trangthai');
        //echo ( $trangthai1);
        if(empty($trangthai1)){
            $error['trangthai'] = 'Bạn chưa nhập trạng thái.';
        }
        if(!$error){
            echo update_BIL_by_ID($id,$trangthai1);
        }
    }
    //Lấy thông tin trạng thái

    if(!empty($id)){
        //echo (" SELECT TRANGTHAI FROM HOADON WHERE IDHOADON=".$id);
        //echo "UPDATE HOADON SET TRANGTHAI = 'Đã Giao' WHERE IDHOADON = {$id}";
        $trangthais =db_get_row(" SELECT TRANGTHAI FROM HOADON WHERE IDHOADON=".$id);
        //echo ($trangthai['TRANGTHAI'][0]);
    }

    // Tìm tổng số records    
    $result = db_get_row("SELECT count(CT.IDCHITIETHD) AS counter FROM HOADON HD, CHITIETHOADON CT, SANPHAM SP WHERE HD.IDHOADON=CT.HOADON AND SP.IDSANPHAM=CT.SANPHAM AND HD.IDHOADON=".$id);
    $total_records = $result["COUNTER"][0];

     
    // Lấy trang hiện tại
    $current_page = input_get('page');
     
    // Lấy limit
    $limit = 10;

    $link = create_link(base_url('admin'), array(
        'm' => 'bill',
        'a' => 'list',
        'page' => '{page}'
    ));
     
    // Thực hiện phân trang
    $paging = paging($link, $total_records, $current_page, $limit);

    // Lấy danh sách Hóa đơn    
    //$bills = db_get_list("SELECT * FROM HOADON HD,TAIKHOAN TK WHERE HD.TAIKHOAN=TK.IDTAIKHOAN");

 ?>
 <?php  include_once "widgets/header.php"; ?>
 <div class="container">

        <h3 style="text-align: center;">Chi tiết hóa đơn</h3>
        <div class="controls">


            <a style="display: none;" class="btn btn-default" href="<?php echo create_link(base_url('admin'), array('m' => 'bill', 'a' => 'add')); ?>">Thêm</a>
            <form action="<?php echo '?m=bill&a=detail&idhd='.$id; ?>" method="POST" role="form" enctype="multipart/form-data">
                <div class="form-group">

                    <label for="TRANGTHAI">Trạng thái</label>
                    <select class="form-control" name="trangthai" id="trangthai">
                        <option value="Đã giao" class="<?php if($trangthais['TRANGTHAI'][0]=="Đã giao") echo 'active'; ?>">Đã giao</option>
                        <option value="Đang giao" class="<?php if($trangthais['TRANGTHAI'][0]=="Đang giao") echo 'active'; ?>">Đang giao</option>                                                
                    </select>
                    <!-- <input type="text" class="form-control" name="trangthai" id="trangthai"  value="<?php //echo $trangthais['TRANGTHAI'][0]; ?>"> -->
                    <span class="error">
                        <?php 
                            if(is_submit('editTrangthai')){
                                if(!empty($error['trangthai'])){
                                    echo $error['trangthai'];
                                }
                            }
                        ?>
                    </span>
                </div>
                <input type="hidden" name="request" value="editTrangthai">      
                <button type="submit" class="btn btn-primary">Cập nhật trạng thái</button>


               
            </form>
            


        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>THành Tiền</th>
                    <th>ID Hóa Đơn</th>
                    <th></th>           
                    <th></th>           
                </tr>
            </thead>
            <tbody>
                <?php 
                    $dem = 0;            
                    for($i = $paging['start'];$i< count($bills['IDHOADON']);++$i){
                        if($dem==$paging['limit'])
                            break;
                        //$editlink = create_link(base_url('admin'), array('m' => 'bill', 'a' => 'edit', 'idct' => $bills['IDCHITIETHD'][$i]));
                        //$dellink = create_link(base_url('admin'), array('m' => 'bill', 'a' => 'delete', 'idct' => $bills['IDCHITIETHD'][$i]));
                        echo "<tr>";
                        //echo "<td>".$bills['NGAYLAP'][$i]."</td>";
                        //echo "<td>".$bills['TRANGTHAI'][$i]."</td>";
                        //echo "<td>".$bills['HOTEN'][$i]."</td>";
                        echo "<td>".$bills['TENSANPHAM'][$i]."</td>";
                        echo "<td>".$bills['SOLUONG'][$i]."</td>";
                        echo "<td>".$bills['THANHTIEN'][$i]."</td>";
                        echo "<td>".$bills['HOADON'][$i]."</td>";
                        //echo "<td><a href='{$detail_link}'>Chi tiết<a/></td>";
                        //echo "<td><a href='{$editlink}'>Sửa<a/></td>";
                        //echo "<td><a href='{$dellink}'>Xóa<a/></td>";
                        echo "</tr>";
                        ++$dem;
                    }
                ?>
            </tbody>
        </table>
        <div style="text-align: center;">
            <ul class="pagination">        
                <?php 
                    echo $paging['html'];
                ?>        
            </ul>         
         </div>
    </div>     
 </div>
<span id="test"></span>
 <?php  include_once "widgets/footer.php"; ?>
