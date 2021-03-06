 
<?php 
    if (!is_admin()){
        echo "<script>window.location.href='".create_link(base_url('admin'), array('m' => 'common', 'a' => 'logout'))."'</script>"; 
    }
    // Tìm tổng số records    
    $result = db_get_row('SELECT count(hd.idhoadon) AS counter FROM HOADON HD,TAIKHOAN TK WHERE HD.TAIKHOAN=TK.IDTAIKHOAN');
    $total_records = $result["COUNTER"][0];

     
    // Lấy trang hiện tại
    $current_page = input_get('page');
     
    // Lấy limit
    $limit = 100;

    $link = create_link(base_url('admin'), array(
        'm' => 'bill',
        'a' => 'list',
        'page' => '{page}'
    ));
     
    // Thực hiện phân trang
    $paging = paging($link, $total_records, $current_page, $limit);

    // Lấy danh sách Sản phẩm    
    $bills = db_get_list("SELECT * FROM HOADON HD,TAIKHOAN TK WHERE HD.TAIKHOAN=TK.IDTAIKHOAN");

 ?>
 <?php  include_once "widgets/header.php"; ?>
 <div class="content">
    <div class="col-md-8 col-md-push-2 col-md-pull-2">
        <h3 style="text-align: center;">Danh sách hóa đơn</h3>
<!--         <div class="controls">
            <a class="btn btn-default" href="<?php //echo create_link(base_url('admin'), array('m' => 'bill', 'a' => 'add')); ?>">Thêm</a>
        </div> -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th>Trạng thái</th>
                    <th>Tên khách hàng</th>
                    <th></th>
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
                        //$editlink = create_link(base_url('admin'), array('m' => 'bill', 'a' => 'edit', 'idhd' => $bills['IDHOADON'][$i]));
                        $dellink = create_link(base_url('admin'), array('m' => 'bill', 'a' => 'delete', 'idhd' => $bills['IDHOADON'][$i]));
                        $detail_link = create_link(base_url('admin'), array('m' => 'bill', 'a' => 'detail', 'idhd' => $bills['IDHOADON'][$i]));
                        echo "<tr>";
                        echo "<td>".$bills['NGAYLAP'][$i]."</td>";
                        echo "<td>".$bills['TRANGTHAI'][$i]."</td>";
                        echo "<td>".$bills['HOTEN'][$i]."</td>";
                        //echo "<td>".$bills['TENSANPHAM'][$i]."</td>";
                        //echo "<td>".$bills['SOLUONG'][$i]."</td>";
                        //echo "<td>".$bills['THANHTIEN'][$i]."</td>";
                        echo "<td><a href='{$detail_link}'>Chi tiết<a/></td>";
                        //echo "<td><a href='{$editlink}'>Sửa<a/></td>";
                        echo "<td><a href='{$dellink}'>Xóa<a/></td>";
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
