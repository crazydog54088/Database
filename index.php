<?php
  $server='localhost';                     //主機
  $db_username='toolwebsiteszoo_send';     //你的資料庫用戶名
  $db_password='Asd183927!';               //你的資料庫密碼
  $db_tables='toolwebsiteszoo_send';       // 預設使用的資料庫名稱 
$con = mysqli_connect( 
            $server,  
            $db_username,      
            $db_password,  
            $db_tables);  
if ( !$con ) {
   echo "MySQL資料庫連接錯誤!<br/>";
   exit();
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>貨運查詢</title>
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <br><br><Br>
  <form action="#" method="post">
    <lable>輸入sql語法:</lable>
　<input type="text" name="func">
　<input type="submit" value="送出表單"><br>
　<font color="blue">SQL語法: <?php echo $_POST['func'];?></font>
</form>
<br>

<?php
mysqli_query($con,"set names utf8");
if(isset($_POST['func'])){
    $sql = $_POST['func'];
    $result = mysqli_query($con,$sql) or die('語法錯誤');
    while($row = mysqli_fetch_array($result)){
        print_r($row);
        echo "<br>";
    }
}
?>
<hr>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3">
查詢消費最多的客戶
</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
查詢最熱銷商品
</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
未在承諾時間內送達的包裹
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">查詢消費最多的客戶</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        $max = 0;
        $u_id=0;
        $sql = "SELECT * FROM `user`";
        $result = mysqli_query($con,$sql) or die('語法錯誤');
        while($row = mysqli_fetch_array($result)){
            $sql2= "SELECT * FROM `package` WHERE `sender_id` = ".$row['id'];
            $result2 = mysqli_query($con,$sql2) or die('語法錯誤');
            $sum = 0;
            while($row2 = mysqli_fetch_array($result2)){
                $sum = $sum + $row2['cost'];
            }
            if($sum > $max){
                $max = $sum;
                $u_id = $row['id']; }
        }
        $sql3 = "SELECT * FROM `user` WHERE `id` = $u_id";
        $result3 = mysqli_query($con,$sql3) or die('語法錯誤');
        $row3 = mysqli_fetch_array($result3);
        echo "查詢消費最多的客戶".$row3['username']."，共花費".$max."元"
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">未在承諾時間內送達的包裹</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        $sql = "SELECT * FROM `pg_log` WHERE `state` LIKE '已簽收'";
        $result = mysqli_query($con,$sql) or die('語法錯誤');
        while($row = mysqli_fetch_array($result)){
             $sql2 = "SELECT * FROM `package` WHERE `id` = ".$row['pg_id'];
             $result2 = mysqli_query($con,$sql2) or die('語法錯誤');
             $row2 = mysqli_fetch_array($result2);
             $time1=$row2['arrive_time']; // 到店寄貨時間	
             $time2=$row['update_time']; //實際送到時間
             if((strtotime($time2) - strtotime($time1))> ($row2['pg_expected_time']*60) ){
                 //送達時間減掉出貨時間 大於 pg_expected_time(分鐘)*60
                 echo "貨運 #".$row2['id']."已超時";
             }
        }
 
        
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">查詢最熱銷商品</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        $sql = "SELECT `sender_id`, count( * ) AS count FROM package GROUP BY `sender_id` ORDER BY count DESC LIMIT 1";
        $result = mysqli_query($con,$sql) or die('語法錯誤');
        $row = mysqli_fetch_array($result);
        $sql = "SELECT `sender_id`, count( * ) AS count FROM package GROUP BY `sender_id` ORDER BY count DESC LIMIT 1";
        $result = mysqli_query($con,$sql) or die('語法錯誤');
        $row = mysqli_fetch_array($result);
        $sql = "SELECT * FROM `user` WHERE `id` = ".$row['sender_id'];
        $result = mysqli_query($con,$sql) or die('語法錯誤');
        $row = mysqli_fetch_array($result);
        echo $row['username'];
        echo "<br>";
        
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
