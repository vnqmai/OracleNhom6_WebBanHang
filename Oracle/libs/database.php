<?php 
    // Biến lưu trữ kết nối
    $conn = null;
     
    // Hàm kết nối
   function db_connect(){
        //CONNECT DATABASE 
        $username = "sys";                  // Use your username
        $password = "Quanlybanhang6";             // and your password
        $database = "localhost/qlbhnhom6";   // and the connect string to connect to your database
             
        global $conn;
        $conn = oci_connect($username, $password, $database,'AL32UTF8');
        if (!$conn) {
            $m = oci_error();
            trigger_error('Could not connect to database: '. $m['message'], E_USER_ERROR);          
        }                       
        return $conn;
    }
     
    // Hàm ngắt kết nối
    function db_close(){
        global $conn;
        if ($conn){
            oci_close($conn);
        }
    }    
     
    // Hàm lấy danh sách, kết quả trả về danh sách các record trong một mảng
    function db_get_list($sql){
        db_connect();
        global $conn;
        $res = execute($sql);
        $data = "";
        if(!$res){
            $data = 0;
        }
        else{
            $ndata = oci_fetch_all($res,$data);
        }           
        return $data;
    }
     
    // Hàm lấy chi tiết, dùng select theo ID vì nó trả về 1 record
    function db_get_row($sql){
        db_connect();
        global $conn;
        $res = execute($sql);
        $data = "";
        if($res){
            oci_fetch_all($res,$data);
        }
        else
            $data = 0;
        return $data;
    }
     
    // Hàm thực thi câu truy  vấn insert, update, delete
    function execute($sql){
        db_connect();
        global $conn;
        $res = oci_parse($conn,$sql);
        oci_execute($res);
        return $res;
    }
 ?>