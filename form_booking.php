<?php
  //เรียกใช้งานไฟล์เชื่อมต่อฐานข้อมูล
  require_once 'condb.php';
  //query
  $query = "SELECT * FROM tbl_tables WHERE id=$_GET[id]";
  $result = mysqli_query($condb, $query);
  $row = mysqli_fetch_array($result);
  //print_r($row);
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>แสดงข้อมูลห้องพักเพื่อทำการจอง</title>
    <style type="text/css">
      .masiron{
        background-color: #ffffff;
      }
    </style>
  </head>

  <body style="background-image: linear-gradient(#3498db,#2ecc71, #1abc9c);">
    <div class="container">
      <div class="row">
        <div class="col-sm-2 col-md-2"></div>
        <div class="col-12 col-sm-11 col-md-8 masiron" style="margin-top: 25px;">
          <br>
          <h4 align="center" style="color: red;">กรุณากรอกข้อมูลจองที่พัก</h4>
          <br>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <div class="alert alert-warning" role="alert">
                <center><font color="red"> <b> ระบบจะบันทึกการจองที่พัก ลูกค้าสามารถเลือกจองได้ ตามวันเวลาที่ต้องการ</b></font> </center>
              </div>

              <hr>
                <div style="margin-left: 20px;">
                  <form action="save_bookings.php" method="post">

                    <div class="form-group row">
                      <label class="col-sm-3 ">ชื่อรายการ</label>
                      <div class="col-sm-7">
                        <input type="text" name="table_name" class="form-control" disabled value="<?php echo $row['table_name'];?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 ">ชื่อผู้จอง</label>
                      <div class="col-sm-7">
                        <input type="text" name="name" class="form-control" disabled value="<?php echo $row['name'];?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 ">นามสกุลผู้จอง</label>
                      <div class="col-sm-7">
                        <input type="text" name="surname" class="form-control" disabled value="<?php echo $row['surname'];?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 ">วันที่เช็คอิน</label>
                      <div class="col-sm-7">
                        <input type="date" name="check_in" class="form-control" min="<?php echo date('Y-m-d');?>" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 ">วันที่เช็คเอาต์</label>
                      <div class="col-sm-7">
                        <input type="date" name="check_out" class="form-control" min="<?php echo date('Y-m-d');?>" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 ">เวลาเข้าพัก</label>
                      <div class="col-sm-7">
                       <input type="time" name="time" class="form-control" required placeholder="เวลา" required>
                     </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 ">เบอร์โทร</label>
                      <div class="col-sm-7">
                        <input type="text" name="phone" class="form-control" required placeholder="เบอร์โทร" minlength="10" maxlength="10">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 ">ผู้บันทึก</label>
                      <div class="col-sm-7">
                        <input type="text" name="stutus" class="form-control" readonly value="ลูกค้า">
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="col-sm-3 "></label>
                      <div class="col-sm-10">
                       <input type="hidden" name="table_name" value="<?php echo $_GET['id'];?>">
                       <button type="submit" class="btn btn-success">ยืนยันการจองห้องพัก</button>
                       <a href="index.php" class="btn btn-danger">ยกเลิกการจองห้องพัก</a>
                      </div>
                    </div>

                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
      </body>
    </html>


