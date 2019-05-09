 
<?php 

    if (!is_admin()){
        redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
    }

    // Tìm tổng số records    
    $result = db_get_row('SELECT count(IDTAIKHOAN) AS counter FROM TAIKHOAN');
    $total_records = $result["COUNTER"][0];

     
    // Lấy trang hiện tại
    $current_page = input_get('page');
     
    // Lấy limit
    $limit = 20;

    $link = create_link(base_url('admin'), array(
        'm' => 'user',
        'a' => 'list',
        'page' => '{page}'
    ));
     
    // Thực hiện phân trang
    $paging = paging($link, $total_records, $current_page, $limit);

    // Lấy danh sách Sản phẩm    
    $users = db_get_list("SELECT * FROM TAIKHOAN TK, LOAITAIKHOAN L WHERE L.IDLOAITK = TK.LOAITK ");

 ?>
 <?php  include_once "widgets/header.php"; ?>
 <div class="content">
    <div class="col-md-8 col-md-push-2 col-md-pull-2">
        <h3 style="text-align: center;">Danh sách thành viên</h3>
        <div class="controls">
            <a class="btn btn-default" href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'add')); ?>">Thêm thành viên</a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tên đăng nhập</th>
                    <th>Mật khẩu</th>
                    <th>Họ tên</th>
                    <th>Địa chỉ</th> 
                    <th>Số điện thoại</th>
                    <th>Email</th>           
                    <th>Loại tài khoản</th>           
                </tr>
            </thead>
            <tbody>
                <?php 
                    $dem = 0;            
                    for($i = $paging['start'];$i< count($users['IDTAIKHOAN']);++$i){
                        if($dem==$paging['limit'])
                            break;
                        $editlink = create_link(base_url('admin'), array('m' => 'user', 'a' => 'edit', 'idtk' => $users['IDTAIKHOAN'][$i]));
                        $dellink = create_link(base_url('admin'), array('m' => 'user', 'a' => 'delete', 'idtk' => $users['IDTAIKHOAN'][$i]));
                        echo "<tr>";
                        echo "<td>".$users['TENDN'][$i]."</td>";
                        echo "<td>".$users['MATKHAU'][$i]."</td>";
                        echo "<td>".$users['HOTEN'][$i]."</td>";
                        echo "<td>".$users['DIACHI'][$i]."</td>";
                        echo "<td>".$users['SODIENTHOAI'][$i]."</td>";
                        echo "<td>".$users['EMAIL'][$i]."</td>";
                        echo "<td>".$users['LOAITK'][$i]."</td>";
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
