<?php
session_start();
//เรียกใช้งานไฟล์เชื่อมต่อฐานข้อมูล
require_once 'condb.php';
//query
$query = "SELECT * FROM tbl_table ORDER BY id ASC";
$result = mysqli_query($condb, $query);
?>

<?php
echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

if(empty($_SESSION['id']) && empty($_SESSION['name']) && empty($_SESSION['surname'])){
            echo '<script>
                setTimeout(function() {
                swal({
                title: "คุณต้องทำการล็อกอินเข้าสู่ระบบก่อนน่ะครับ!!!",
                type: "error"
                }, function() {
                window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
                </script>';
            exit();
}
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>แสดงรายการห้องพัก และ เต็นท์</title>
    <style type="text/css">
    .masiron{
      background-color: #ffffff;
    }
    </style>
  </head>

  <body style="background-image: linear-gradient(-45deg, #3498db,#2ecc71, #1abc9c, #B3FF70);">
    <div class="container">
      <div class="row">
        <div class="col-sm-2 col-md-2"></div>
        <div class="col-12 col-sm-11 col-md-12 masiron" style="margin-top: 30px;">
          <br>
          <h4 align="center" style="color: red;">แสดงสถานะห้องพัก และ เต็นท์</h4>
          <br>
          <div class="row">
            <div class="col-sm-13 col-md-13">
              <div class="alert alert-warning" role="alert">
                <center>Room And Tent Tables</center>
                <center>ตารางห้องพัก และ เต็นท์</center>
              </div>
              
              <hr>
              <div class="row" style="margin-bottom: 20px;">
                <?php foreach ($result as  $row) {
                  if($row['table_status']==0){ //0 = ว่าง
                    echo '<div class="col-3 col-md-3 col-sm-3" style="margin: 5px; padding-left: 190px;">';
                    echo '<a href="booking.php?id='.$row["id"].'&act=booking"class="btn btn-success" target="_blank">'.$row['table_name'].'</a></div>';
                    }else{ //1 = ถูกจอง
                      echo '<div class="col-3 col-md-3 col-sm-3" style="margin: 5px; padding-left: 190px;">';
                      echo '<a href="#" class="btn btn-secondary disabled" target="_blank">'.$row['table_name'].'</a></div>';
                      }
                    } 
                    ?>
                  </div>
                  <p><i class="fa-solid fa-square-check fa-2xl" style="color: #62ff1a; margin: 10px; font-size: 20px;"> : สถานะว่าง</i></p>
                  <p><i class="fa-solid fa-square-xmark fa-2xl" style="color: #737373; margin: 10px; font-size: 20px;"> : สถานะไม่ว่าง</i></p>
                  <a href="index.php" class="btn btn-danger" style="margin: 5px;">กลับสู่หน้าหลัก</a>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </body>
    </html>