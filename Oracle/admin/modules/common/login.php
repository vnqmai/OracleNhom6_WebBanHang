<?php
    $error = array();
     
    // BƯỚC 1: KIỂM TRA NẾU LÀ ADMIN THÌ REDIRECT
    if (is_admin()){
        redirect(base_url('admin/?m=common&a=dashboard'));
    }
     
    // BƯỚC 2: NẾU NGƯỜI DÙNG SUBMIT FORM
    if (is_submit('login'))
    {    
        // lấy tên đăng nhập và mật khẩu
        $username = input_post('tendn');
        $password = input_post('matkhau');        
         
        if($username = 'admin'&&$password=='admin'){
            set_logged($user['TENDN'][0], $user['LOAITK'][0]);
            redirect(base_url('admin/?m=common&a=dashboard'));
        }
        // // Kiểm tra tên đăng nhập
        // if (empty($username)){
        //     $error['username'] = 'Bạn chưa nhập tên đăng nhập.';
        // }
         
        // // Kiểm tra mật khẩu
        // if (empty($password)){
        //     $error['password'] = 'Bạn chưa nhập mật khẩu.';
        // }
         
        // // Nếu không có lỗi
        // if (!$error)
        // {
        //     // include file xử lý database user
        //     include_once('database/user.php');
             
        //     // lấy thông tin user theo username
        //     $user = db_user_get_by_username($username);
             
        //     // Nếu không có kết quả
        //     if (empty($user)){
        //         $error['username'] = 'Tên đăng nhập không đúng';
        //     }
        //     // nếu có kết quả nhưng sai mật khẩu
        //     else if (bin2hex($user['MATKHAU'][0]) != sha1($password)){
        //         $error['password'] = 'Mật khẩu bạn nhập không đúng';
        //     }
             
        //     // nếu mọi thứ ok thì tức là đăng nhập thành công 
        //     // nên thực hiện redirect sang trang chủ
        //     if (!$error){
                
        //     }
        // }         
    }   
?>

<style type="text/css">
    h1{text-align: center;}
    form{width: 500px; margin: auto;}
    .error{color: red;}
</style>
<?php include_once('widgets/header.php'); ?>

<form action="<?php echo base_url('admin/?m=common&a=login'); ?>" method="POST" role="form">
    <legend>Đăng nhập</legend>            
    <div class="form-group">
        <label for="">Username</label>
        <input type="text" class="form-control" name="tendn" id="tendn" placeholder="Nhập tên đăng nhập...">
        <span class="error">
            <?php 
                if(is_submit('login')){
                    if($error['username']!=null)
                        echo "<span>".$error["username"]."</span><br/>";
                }
             ?>
        </span>
    </div>
    <div class="form-group">
        <label for="">Password</label>
        <input type="password" class="form-control" name="matkhau" id="matkhau" placeholder="Nhập mật khẩu...">
        <span class="error">
            <?php 
                if(is_submit('login')){
                    if($error['password']!=null)
                        echo "<span>".$error["password"]."</span><br/>";
                }
             ?>
        </span>
    </div>
    <input type="hidden" name="request" value="login">
    <button type="submit" class="btn btn-primary">Đăng nhập</button>
</form>
<br>

<?php include_once('widgets/footer.php'); ?>