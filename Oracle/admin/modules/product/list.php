 
<?php     
    if (!is_admin()){
        echo "<script>window.location.href='".create_link(base_url('admin'), array('m' => 'common', 'a' => 'logout'))."'</script>"; 
    }
    // Tìm tổng số records    
    $result = db_get_row('SELECT count(IDSANPHAM) AS counter FROM SANPHAM');
    $total_records = $result["COUNTER"][0];

     
    // Lấy trang hiện tại
    $current_page = input_get('page');
     
    // Lấy limit
    $limit = 5;

    $link = create_link(base_url('admin'), array(
        'm' => 'product',
        'a' => 'list',
        'page' => '{page}'
    ));
     
    // Thực hiện phân trang
    $paging = paging($link, $total_records, $current_page, $limit);

    // Lấy danh sách Sản phẩm    
    $products = db_get_list("SELECT * FROM SANPHAM SP, LOAISANPHAM L, THUONGHIEU T WHERE SP.LOAISP = L.IDLOAISP AND SP.THUONGHIEU = T.IDTHUONGHIEU");

 ?>
 <?php  include_once "widgets/header.php"; ?>
 <div class="content">
    <div class="col-md-8 col-md-push-2 col-md-pull-2">
        <h3 style="text-align: center;">Danh sách sản phẩm</h3>
        <div class="controls">
            <a class="btn btn-default" href="<?php echo create_link(base_url('admin'), array('m' => 'product', 'a' => 'add')); ?>">Thêm</a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Loại sản phẩm</th>
                    <th>Giới tính</th>
                    <th>Thương hiệu</th> 
                    <th>Đơn giá</th>
                    <th></th>           
                    <th></th>           
                </tr>
            </thead>
            <tbody>
                <?php 
                    $dem = 0;            
                    for($i = $paging['start'];$i< count($products['IDSANPHAM']);++$i){
                        if($dem==$paging['limit'])
                            break;
                        $editlink = create_link(base_url('admin'), array('m' => 'product', 'a' => 'edit', 'idsp' => $products['IDSANPHAM'][$i]));
                        $dellink = create_link(base_url('admin'), array('m' => 'product', 'a' => 'delete', 'idsp' => $products['IDSANPHAM'][$i]));
                        echo "<tr>";
                        echo "<td>".$products['TENSANPHAM'][$i]."</td>";
                        echo "<td><img src='../images/".rawurlencode($products['HINH'][$i])."' width='100px' height='100px'/></td>";
                        echo "<td>".$products['TENLOAISP'][$i]."</td>";
                        echo "<td>".$products['GIOITINH'][$i]."</td>";
                        echo "<td>".$products['TENTHUONGHIEU'][$i]."</td>";
                        echo "<td>".$products['DONGIA'][$i]."</td>";
                        echo "<td><a href='{$editlink}'>Sửa<a/></td>";
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
