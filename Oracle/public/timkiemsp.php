  <?php 
                            include("dbconnect.php");            
                                 if(isset($_POST["TenSP"]) && $_POST["Ten"] !="")
                                  {
                                  $TenSP=$_POST["Ten"];
                                  $string=strtolower($TenSP);
                                  $result=mysqli_query($conn,"SELECT * FROM sanpham where lower(tensp) LIKE '%$string%'" );
                                  if(mysqli_num_rows($result)<>0)
                                  {
                                   $n=mysqli_num_rows($result);
                                   echo"Kết quả tìm kiếm:";
                                    echo"<b align='center' style='color:#ff4d4d'><span>Có $n sản phẩm được tìm thấy</span></b>";
                                     while($row=mysqli_fetch_array($result))
                                    {
?>                       