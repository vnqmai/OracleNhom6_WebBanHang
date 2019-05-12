<?php     
	if (!defined('IN_SITE')) die ('The request not found');    
    ob_start();
    //tổng lượng view (các sản phẩm) trong 1 ngày --> show chart
    $query1 = "SELECT SUM(SOLUONG) AS SL, NGAY FROM LUONGVIEWSANPHAM GROUP BY NGAY ORDER BY NGAY ASC";
    $charvalue = db_get_list($query1);    

    //tổng lượng view (các ngày trong tháng) của 1 sp --> sắp xếp giảm dần --> nhận xét
    // $query2 = "SELECT SUM(SOLUONG) AS SL, SANPHAM FROM LUONGVIEWSANPHAM L, SANPHAM S WHERE L.SANPHAM = S.IDSANPHAM AND TO_CHAR(NGAY,'mm') = '04' GROUP BY L.SANPHAM ORDER BY SL DESC";
    $query2 = "SELECT SUM(SOLUONG) AS SL, S.TENSANPHAM AS SP FROM LUONGVIEWSANPHAM L, SANPHAM S WHERE L.SANPHAM = S.IDSANPHAM AND TO_CHAR(NGAY,'mm') = '05' GROUP BY S.TENSANPHAM ORDER BY SL DESC";
    $comment = db_get_list($query2);
    
    
 ?>


 <script type="text/javascript" src="../libs/Chart.min.js"></script>
 <div class="row">
     <div class="col-md-8">
            <h3 style="margin-left: 30px;">
                Lượng view theo ngày trong tháng
                <select>
                    <?php 
                        for ($i=1; $i <=12 ; $i++) { 
                            if($i == date('m'))
                                echo "<option value='{$i}' selected>Tháng {$i}</option>";
                            else
                                echo "<option value='{$i}'>Tháng {$i}</option>";
                        }
                     ?>
                </select>
            </h3>
          <canvas id="buyers" width="740" height="300"></canvas>
     </div>
     <div class="col-md-4">
            <h3 style="text-align: center;">Top 3 sản phẩm được xem nhiều nhất</h3>
            <table class="table">
                <thead>
                    <th>Sản phẩm</th>
                    <th>Lượng view</th>
                </thead>
                <tbody>
             <?php             
                for($i = 0;$i<3;++$i){
                    echo "<tr><td>".$comment['SP'][$i]."</td>";
                    echo "<td>".$comment['SL'][$i]."</td></tr>";
                }
              ?>
                </tbody>
            </table>
     </div>
 </div> 
 <script>
// line chart data
    var buyerData = {
    labels : <?php echo json_encode($charvalue['NGAY']); ?>,
    datasets : [
        {
            fillColor : "rgba(172,194,132,0.4)",
            strokeColor : "#ACC26D",
            pointColor : "#fff",
            pointStrokeColor : "#9DB86D",
            data : <?php echo json_encode($charvalue['SL']); ?>
        }
    ]
}
    var buyers = document.getElementById('buyers').getContext('2d');
    new Chart(buyers).Line(buyerData);
</script>
<style type="text/css">
    canvas{}
</style>
<?php 
ob_flush();
 ?>