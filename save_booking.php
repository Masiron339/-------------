<?php

echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

//เรียกใช้งานไฟล์เชื่อมต่อฐานข้อมูล
require_once 'condb.php';

//print_r($_POST);

if (isset($_POST['table_id']) && isset($_POST['booking_name']) && isset($_POST['booking_date'])) {
	

//ประกาศตัวแปรรับค่าจากฟอร์ม

$booking_name = $_POST['booking_name'];
$booking_lastname = $_POST['booking_lastname'];
$booking_date = $_POST['booking_date'];
$booking_checkout = $_POST['booking_checkout'];
$booking_time = $_POST['booking_time'];
$booking_phone = $_POST['booking_phone'];
$booking_staff = $_POST['booking_staff'];
$table_id = $_POST['table_id'];
$dateCreate = date('Y-m-d H:i:s'); //วันที่บันทึก

//insert booking
mysqli_query($condb, "BEGIN");
$sqlInsertBooking	= "INSERT INTO  tbl_booking values(null, '$table_id', '$booking_name', '$booking_lastname', '$booking_date', '$booking_checkout', '$booking_time', '$booking_phone', '$booking_staff', '$dateCreate')";
$rsInsertBooking	= mysqli_query($condb, $sqlInsertBooking);
 
//การใช้ Transection ประกอบด้วย  BEGIN COMMIT ROLLBACK 


//update table status
$sqlUpdate ="UPDATE tbl_table SET table_status=1 WHERE id = $table_id"; //1=จอง
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