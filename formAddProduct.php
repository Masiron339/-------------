<?php
session_start();
//เรียกใช้งานไฟล์เชื่อมต่อฐานข้อมูล
require_once 'condb.php';
//query
$query = "SELECT * FROM tbl_payments ORDER BY id ASC";
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


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>อัปโหลดหลักฐานชำระเงิน</title>
        <!-- sweet alert  -->
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12"> <br>
                  <?php 
                  //ถ้ามีการส่งพารามิเตอร์ method get และ  method get ชือ act = add จะแสดงฟอร์มเพิ่มข้อมูล
                  if(isset($_GET['act']) && $_GET['act']=='add'){ ?>
                    <h3>อัปโหลดหลักฐานชำระเงิน <i class="fa-regular fa-credit-card"></i> </h3><br>
                    <form  method="post" enctype="multipart/form-data">
                      ชื่อ
                        <input type="text" name="payment_name" required class="form-control" placeholder="ชื่อ" minlength="4"> <br>
                      นามสกุล
                        <input type="text" name="payment_lastname" required class="form-control" placeholder="นามสกุล" minlength="4"> <br>
                      ชื่อบัญชี และ หมายเลขธนาคาร <font color="red">*กรณีโอนค่ามัดจำกลับ* </font>
                        <input type="text" name="payment_bank" required class="form-control" placeholder="เลขบัญชีธนาคาร" minlength="4"> <br>
                      รายละเอียด
                        <textarea name="payment_detail" required class="form-control" placeholder="รายละเอียด"></textarea> <br>
                      ราคา
                        <input type="number" name="payment_price" required class="form-control" min="0"> <br>
                      อัปโหลดหลักฐานชำระเงิน
                        <input type="file" name="payment_img" required   class="form-control" accept="image/jpeg, image/png, image/jpg"> <br>
                        <div class="row">
                        <div class="d-grid gap-2 col-sm-6">
                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
                      </div>
                      <div class="d-grid gap-2 col-sm-6">
                        <a href="formAddProduct.php" class="btn btn-warning">ยกเลิก</a>
                      </div>
                    </div>
                        <br>
                    </form>
                  <?php } ?>
                    <h3>รายการชำระเงิน
                    <a href="formAddProduct.php?act=add" class="btn btn-info btn-sm">+ อัปโหลดหลักฐานชำระเงิน <i class="fa-sharp fa-solid fa-money-bill"></i></a> </h3>
                    <table class="table table-striped  table-hover table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">ลำดับ</th>
                                <th width="10%">ภาพ</th>
                                <th width="25%">ชื่อผู้อัปโหลด</th>
                                <th width="25%">นามสกุลผู้อัปโหลด</th>
                                <th width="25%">บัญชีธนาคาร</th>
                                <th width="40%">รายละเอียด</th>
                                <th width="20%" class="text-center">ราคา</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //เรียกไฟล์เชื่อมต่อฐานข้อมูล
                            require_once 'connect.php';
                            //คิวรี่ข้อมูลมาแสดงในตาราง
                            $stmt = $conn->prepare("SELECT* FROM tbl_payments");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach($result as $row) {
                            ?>
                            <tr>
                                <td><?= $row['id'];?></td>
                                <td><img src="upload/<?= $row['payment_img'];?>" width="70%"></td>
                                <td><?= $row['payment_name'];?></td>
                                <td><?= $row['payment_lastname'];?></td>
                                <td><?= $row['payment_bank'];?></td>
                                <td><?= $row['payment_detail'];?></td>
                                <td align="right"><?= number_format($row['payment_price'],2);?></td>
                            </tr> 
                            <?php } ?>
                        </tbody>
                    </table>
                    <a href="index.php" class="btn btn-danger" style="margin: 3px;">กลับสู่หน้าหลัก</a>
                    <br>
                </div>
            </div>
        </div>
    </body>
</html>

<?php 

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit();



//ตรวจสอบตัวแปรที่ส่งมาจากฟอร์ม
if (isset($_POST['payment_name']) && isset($_POST['payment_price']) && $_POST['payment_price'] >=0) {
  //ไฟล์เชื่อมต่อฐานข้อมูล
    require_once 'connect.php';
     //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    $date1 = date("Ymd_His");
    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    $numrand = (mt_rand());
    $payment_img = (isset($_POST['payment_img']) ? $_POST['payment_img'] : '');
    $upload=$_FILES['payment_img']['name'];

    //มีการอัพโหลดไฟล์
    if($upload !='') {
    //ตัดขื่อเอาเฉพาะนามสกุล
    $typefile = strrchr($_FILES['payment_img']['name'],".");

    //สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
    if($typefile =='.jpg' || $typefile  =='.jpg' || $typefile  =='.png'){

    //โฟลเดอร์ที่เก็บไฟล์
    $path="upload/";
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname = $numrand.$date1.$typefile;
    $path_copy=$path.$newname;
    //คัดลอกไฟล์ไปยังโฟลเดอร์
    move_uploaded_file($_FILES['payment_img']['tmp_name'],$path_copy); 

     //ประกาศตัวแปรรับค่าจากฟอร์ม
    $payment_name = $_POST['payment_name'];
    $payment_lastname = $_POST['payment_lastname'];
    $payment_bank = $_POST['payment_bank'];
    $payment_detail = $_POST['payment_detail'];
    $payment_price = $_POST['payment_price'];
    
    //sql insert
    $stmt = $conn->prepare("INSERT INTO tbl_payments 
    (payment_name, payment_lastname, payment_bank, payment_detail, payment_price, payment_img)
    VALUES 
    (:payment_name, :payment_lastname, :payment_bank, :payment_detail, :payment_price, '$newname')");
    //bindParam data type
    $stmt->bindParam(':payment_name', $payment_name, PDO::PARAM_STR);
    $stmt->bindParam(':payment_lastname', $payment_lastname, PDO::PARAM_STR);
    $stmt->bindParam(':payment_bank', $payment_bank, PDO::PARAM_STR);
    $stmt->bindParam(':payment_detail', $payment_detail, PDO::PARAM_STR);
    $stmt->bindParam(':payment_price', $payment_price, PDO::PARAM_INT);
    $result = $stmt->execute();
    $conn = null; //close connect db

    //เงื่อนไขตรวจสอบการเพิ่มข้อมูล
          if($result){
                echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "อัปโหลดหลักฐานชำระเงินสำเร็จ",
                          type: "success"
                      }, function() {
                          window.location = "formAddProduct.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
            }else{
               echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เกิดข้อผิดพลาดในการอัปโหลดหลักฐานชำระเงิน",
                          type: "error"
                      }, function() {
                          window.location = "formAddProduct.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
            } //else ของ if result

        
        }else{ //ถ้าไฟล์ที่อัพโหลดไม่ตรงตามที่กำหนด
            echo '<script>
                         setTimeout(function() {
                          swal({
                              title: "คุณอัพโหลดหลักฐานการชำระเงินไม่ถูกต้อง",
                              type: "error"
                          }, function() {
                              window.location = "formAddProduct.php"; //หน้าที่ต้องการให้กระโดดไป
                          });
                        }, 1000);
                    </script>';
        } //else ของเช็คนามสกุลไฟล์
   
    } // if($upload !='') {

    
    } //isset
?>