<?php

echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

//เรียกใช้งานไฟล์เชื่อมต่อฐานข้อมูล
require_once 'condb.php';

//print_r($_POST);

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['surname'])) {
	

//ประกาศตัวแปรรับค่าจากฟอร์ม

$name = $_POST['name'];
$surname = $_POST['surname'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$time = $_POST['time'];
$phone = $_POST['phone'];
$status = $_POST['status'];

//insert booking
mysqli_query($condb, "BEGIN");
$sqlInsertBooking	= "INSERT INTO  tbl_bookings values(null, '$id', '$name', '$surname', '$check_in', '$check_out', '$time', '$phone', '$status')";
$rsInsertBooking	= mysqli_query($condb, $sqlInsertBooking);
 
//การใช้ Transection ประกอบด้วย  BEGIN COMMIT ROLLBACK 


//update table status
$sqlUpdate ="UPDATE tbl_tables SET status=1 WHERE id = $id"; //1=จอง
$rsUpdate = mysqli_query($condb, $sqlUpdate);


if($rsInsertBooking && $rsUpdate){ //ตรรวจสอบถ้า 2 ตัวแปรทำงานได้ถูกต้องจะทำการบันทึก แต่ถ้าเกิดข้อผิดพลาดจะ Rollback คือไม่บันทึกข้อมูลใดๆ
		mysqli_query($condb, "COMMIT");
		echo 'บันทึกข้อมูลการจองเรียบร้อยแล้ว <a href="formAddProduct.php"> เข้าสู่หน้าระบบชำระเงิน </a>';
		echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "ทำการจองที่พักสำเร็จ",
						   text: "เข้าสู่ระบบหน้าชำระเงิน",
                          type: "success"
                      }, function() {
                          window.location = "formAddProduct.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
	}else{
		mysqli_query($condb, "ROLLBACK");  
		$msg = 'บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ครับ!  <a href="index.php"> กลับหน้าหลัก </a>';	
	}
} //iset 
else{
	header("Location: upload.php");	
}
//ลองเอาไปประยุกต์ใช้ดูครับ devbanban.com
?>