<?php
session_start();
echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

if(empty($_SESSION['id']) && empty($_SESSION['name']) && empty($_SESSION['surname'])){
            echo '<script>
                setTimeout(function() {
                swal({
                title: "คุณไม่มีสิทธิ์ใช้งานหน้านี้",
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
<html>

<!--Head File-->
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>จองที่พัก</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel="stylesheet" href="style.css">
    <script src='main.js'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<!--Body HTML File-->
<body>
    <nav>
        <div class="nav-container">
          <img src="img-resort/logo.jpg" width="90px" style="margin: 110px;">
          <a href="home1.php"><h3 style="color: white"><i class="fa-solid fa-user"></i> ข้อมูลผู้ใช้งาน</h3></a>
          <a href="index.php"><h3 style="color: white"><i class="fa-sharp fa-solid fa-circle-info fa-lg"></i> รายละเอียดห้องพัก</h3></a>
          <a href="zone.php"><h3 style="color: white"><i class="fa-sharp fa-solid fa-book"></i> จองห้องพัก และ เต็นท์</h3></a>
          <a href="formAddProduct.php"><h3 style="color: white"><i class="fa-solid fa-cloud-arrow-up"></i> อัปโหลดหลักฐานชำระเงิน</h3></a>
          <a href="line-notification.php"><h3 style="color: white"><i class="fa-brands fa-line fa-lg"></i> ไลน์ แจ้งเตือน</h3></a>
        </div>
      </nav>
    
      <div class="container">
        <div class="sidebar">
          <input onkeyup="searchsomething(this)" id="txt_search" type="text" class="sidebar-search" placeholder="ค้นหาข้อมูล...">
          <a onclick="searchbooking('all')" class="sidebar-items">ทั้งหมด</a>
          <a onclick="searchbooking('booking_A')" class="sidebar-items">ห้องพักโซน A</a>
          <a onclick="searchbooking('booking_B')" class="sidebar-items">ห้องพักโซน B</a>
          <a onclick="searchbooking('tent')" class="sidebar-items">เต็นท์</a>
          <a href="logout.php" class="sidebar-logout" onclick="return confirm('ยืนยันการออกจากระบบ');">ออกจากระบบ</a>
        </div>
        <div id="productlist" class="booking">
         
        </div>
      </div>
    
      <div id="modalDesc" class="modal" style="display: none;">
        <div onclick="closeModal()" class="modal-bg"></div>
        <div class="modal-page">
          <h2>รายละเอียดห้องพัก</h2>
          <br>
          <div class="modaldesc-content">
            <img id="mdd-img" class="modaldesc-img" src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="">
            <div class="modaldesc-detail">
              <p id="mdd-name" style="font-size: 1.5vw;">ฺBooking name</p>
              <p id="mdd-price" style="font-size: 1.2vw;">1700 THB</p>
              <br>
              <p id="mdd-desc" style="color: #adadad;">Lorem iaudantium harum doloremque alias. Quae, vel ipsum quasi, voluptas, sit optio nemo magni numquam non dicta voluptates porro! Vero eveniet numquam sit aut vel eligendi officiis iste tenetur expedita. Delectus vero quibusdam adipisci in. Esse.</p>
              <br>


              <?php
                  //เรียกใช้งานไฟล์เชื่อมต่อฐานข้อมูล
                  require_once 'condb.php';
                  //query
                  $query = "SELECT * FROM tbl_tables ORDER BY id ASC";
                  $result = mysqli_query($condb, $query);
               ?>
             
              <div class="btn-control">
              <button onclick="closeModal()" class="btn">ยกเลิก</button>
              <a href="zone.php" class="btn btn-buy">เช็คข้อมูลห้องว่าง</a>
              <a href="table.php" class="btn btn-table">อุปกรณ์ภายในห้อง</a>
            </div>
            </div>
          </div>
        </div>
      </div>


      
      
<style>
  @import url("https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500&display=swap");
  * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Noto Sans", sans-serif;
  text-decoration: none;
  -ms-overflow-style: none;  
  scrollbar-width: none;
  }
  body{
   background-image: linear-gradient(-45deg, #3498db,#2ecc71, #1abc9c, #B3FF70);
  }
  img {
  border-radius: 50px;
  }

  /* *::-webkit-scrollbar {
  display: none;
  }*/

  nav {
  width: 100%;
  height: 7vw;
  background-color: black;
  }
  .nav-container {
  max-width: 94vw;
  height: 100%;
  margin: 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  }
  .logonav {
  width: 7vw;
  object-fit: contain;
  }
  .nav-profile {
  display: flex;
  align-items: center;
  }
  .nav-profile-name {
  color: #fff;
  font-size: 1.2vw;
  margin-right: 10px;
  }
  .fa-bookmark {
  font-size: 2vw;
  color: #fff;
  }
  .nav-profile-cart {
  position: relative;
  }
  .cartcount {
  position: absolute;
  top: -15px;
  right: -15px;
  width: 25px;
  height: 25px;
  background: red;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #fff;
  }
  .container {
  width: 90vw;
  margin: 0 auto;
  display: flex;
  }
  .sidebar {
  width: 20%;
  padding: 10px;
  display: flex;
  flex-direction: column;
  }
  .booking {
  width: 140%;
  padding: 10px;
  height: 50%;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-gap: 20px;
  }
  .sidebar-search {
  padding: 10px;
  border: 2px solid transparent;
  width: 100%;
  font-size: 1.2vw;
  outline: none;
  border-radius: 300px;
  background: #f2f2f2;
  transition: 0.3s;
  margin-bottom: 20px;
  }
  .sidebar-search:focus {
  border: 2px solid #e61b36;
  }
  .sidebar-items {
  background: #f2f2f2;
  margin-bottom: 10px;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #e5e5e5;
  color: #000;
  transition: 300ms;
  font-size: 1.2vw;
  }
  .sidebar-items:hover {
  background: #9c1032;
  color: #fff;
  }
  .sidebar-logout {
  background:#FFFFCC;
  margin-bottom: 10px;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #e5e5e5;
  color: #000;
  transition: 300ms;
  font-size: 1.2vw;
  }
  .sidebar-logout:hover {
  background: #9c1032;
  color: #fff;
  }
  .product-items {
  cursor: pointer;
  transition: 0.3s;
  }
  .product-items:hover {
  transform: scale(1.03);
  }
  .product-img {
  width: 100%;
  height: 15vw;
  object-fit: cover;
  border-radius: 10px;
  }
  .modal,
  .modal-bg {
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  }
  .modal-page {
  z-index: 99;
  min-width: 30vw;
  max-width: 60vw;
  max-height: 30vw;
  overflow: scroll;
  background: #fff;
  border-radius: 15px;
  padding: 20px;
  }
  .modaldesc-content {
  width: 100%;
  display: flex;
  }
  .modaldesc-detail {
  margin-left: 20px;
  }
  .modaldesc-img {
  width: 20vw;
  height: 20vw;
  object-fit: cover;
  border-radius: 10px;
  }
  .btn-control {
   display: flex;
   justify-content: flex-end;
   margin-top: 70px;
   }
   .btn {
   padding: 10px 20px;
   color: #fff;
   background: linear-gradient(125deg, #e61b36, #9c1032);
   cursor: pointer;
   border: none;
   border-radius: 5px;
   font-size: 1.2vw;
   transition: 0.3s;
   }
   .btn-buy {
   background: linear-gradient(125deg, #00FF40, #00680C);
   color: #fff;
   margin-left: 20px;
   }
   .btn-table {
   background: linear-gradient(125deg, #00A8DB, #0012B3);
   color: #fff;
   margin-left: 20px;
   }
</style>


<!--Java Script File-->
<script>
    var product = [{
    id: 1,
    img: 'img-resort/โซนA-1.jpg',
    name: 'ห้องใหญ่ โซน  A',
    price: 1700,
    description: 'ห้องพักโซนบี (Zone A) ห้องใหญ่ หลังเดี่ยว ห้องพักราคา 1,700 บาท/คืน อุปกรณ์ภายในห้องพัก มีที่นอนให้สำหรับ 4 ท่าน อนุญาตให้อยู่ได้ไม่เกิน 8 ท่าน สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำห้องพักอยู่ที่ 500 บาท)*' ,
    type: 'booking_A'
 }, {
    id: 2,
    img: 'img-resort/โซนA-1.jpg',
    name: 'ห้องใหญ่ โซน  A',
    price: 1700,
    description: 'ห้องพักโซนบี (Zone A) ห้องใหญ่ หลังเดี่ยว ห้องพักราคา 1,700 บาท/คืน อุปกรณ์ภายในห้องพัก มีที่นอนให้สำหรับ 4 ท่าน อนุญาตให้อยู่ได้ไม่เกิน 8 ท่าน สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำห้องพักอยู่ที่ 500 บาท)*',
    type: 'booking_A'
 }, {
    id: 3,
    img: 'img-resort/โซนA-1.jpg',
    name: 'ห้องใหญ่ โซน  A',
    price: 1700,
    description: 'ห้องพักโซนบี (Zone A) ห้องใหญ่ หลังเดี่ยว ห้องพักราคา 1,700 บาท/คืน อุปกรณ์ภายในห้องพัก มีที่นอนให้สำหรับ 4 ท่าน อนุญาตให้อยู่ได้ไม่เกิน 8 ท่าน สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำห้องพักอยู่ที่ 500 บาท)*',
    type: 'booking_A'
 }, {
    id: 4,
    img: 'img-resort/โซนA-2.jpg',
    name: 'ห้องเล็ก โซน  A',
    price: 1300,
    description: 'ห้องพักโซนบี (Zone A) ห้องเล็ก หลังเดี่ยว ห้องพักราคา 1,300 บาท/คืน อุปกรณ์ภายในห้องพัก มีที่นอนให้สำหรับ 4 ท่าน อนุญาตให้อยู่ได้ไม่เกิน 6 ท่าน สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำห้องพักอยู่ที่ 500 บาท)*',
    type: 'booking_A'
 }, {
    id: 5,
    img: 'img-resort/โซนA-2.jpg',
    name: 'ห้องเล็ก โซน  A',
    price: 1300,
    description: 'ห้องพักโซนบี (Zone A) ห้องเล็ก หลังเดี่ยว ห้องพักราคา 1,300 บาท/คืน อุปกรณ์ภายในห้องพัก มีที่นอนให้สำหรับ 4 ท่าน อนุญาตให้อยู่ได้ไม่เกิน 6 ท่าน สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำห้องพักอยู่ที่ 500 บาท)*',
    type: 'booking_A'
 }, {
    id: 6,
    img: 'img-resort/โซนA-2.jpg',
    name: 'ห้องเล็ก โซน  A',
    price: 1300,
    description: 'ห้องพักโซนบี (Zone A) ห้องเล็ก หลังเดี่ยว ห้องพักราคา 1,300 บาท/คืน อุปกรณ์ภายในห้องพัก มีที่นอนให้สำหรับ 4 ท่าน อนุญาตให้อยู่ได้ไม่เกิน 6 ท่าน สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำห้องพักอยู่ที่ 500 บาท)*',
    type: 'booking_A'
 }, {
    id: 7,
    img: 'img-resort/โซนB.jpg',
    name: 'ห้องใหญ่ โซน  B',
    price: 1700,
    description: 'ห้องพักโซนบี (Zone B) ห้องใหญ่ หลังเดี่ยว ห้องพักราคา 1,700 บาท/คืน อุปกรณ์ภายในห้องพัก มีที่นอนให้สำหรับ 4 ท่าน อนุญาตให้อยู่ได้ไม่เกิน 8 ท่าน สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำห้องพักอยู่ที่ 500 บาท)*',
    type: 'booking_B'
 }, {
    id: 8,
    img: 'img-resort/โซนB.jpg',
    name: 'ห้องใหญ่ โซน  B',
    price: 1700,
    description: 'ห้องพักโซนบี (Zone B) ห้องใหญ่ หลังเดี่ยว ห้องพักราคา 1,700 บาท/คืน อุปกรณ์ภายในห้องพัก มีที่นอนให้สำหรับ 4 ท่าน อนุญาตให้อยู่ได้ไม่เกิน 8 ท่าน สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำห้องพักอยู่ที่ 500 บาท)*',
    type: 'booking_B'
 }, {
    id: 9,
    img: 'img-resort/โซนB.jpg',
    name: 'ห้องใหญ่ โซน  B',
    price: 1700,
    description: 'ห้องพักโซนบี (Zone B) ห้องใหญ่ หลังเดี่ยว ห้องพักราคา 1,700 บาท/คืน อุปกรณ์ภายในห้องพัก มีที่นอนให้สำหรับ 4 ท่าน อนุญาตให้อยู่ได้ไม่เกิน 8 ท่าน สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำห้องพักอยู่ที่ 500 บาท)*',
    type: 'booking_B'
 }, {
    id: 10,
    img: 'img-resort/โซนB.jpg',
    name: 'ห้องใหญ่ โซน  B',
    price: 1700,
    description: 'ห้องพักโซนบี (Zone B) ห้องใหญ่ หลังเดี่ยว ห้องพักราคา 1,700 บาท/คืน อุปกรณ์ภายในห้องพัก มีที่นอนให้สำหรับ 4 ท่าน อนุญาตให้อยู่ได้ไม่เกิน 8 ท่าน สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำห้องพักอยู่ที่ 500 บาท)*',
    type: 'booking_B'
 }, {
    id: 11,
    img: 'img-resort/โซนB.jpg',
    name: 'ห้องใหญ่ โซน  B',
    price: 1700,
    description: 'ห้องพักโซนบี (Zone B) ห้องใหญ่ หลังเดี่ยว ห้องพักราคา 1,700 บาท/คืน อุปกรณ์ภายในห้องพัก มีที่นอนให้สำหรับ 4 ท่าน อนุญาตให้อยู่ได้ไม่เกิน 8 ท่าน สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำห้องพักอยู่ที่ 500 บาท)*',
    type: 'booking_B'
 }, {
    id: 12,
    img: 'img-resort/โซนB.jpg',
    name: 'ห้องใหญ่ โซน  B',
    price: 1700,
    description: 'ห้องพักโซนบี (Zone B) ห้องใหญ่ หลังเดี่ยว ห้องพักราคา 1,700 บาท/คืน อุปกรณ์ภายในห้องพัก มีที่นอนให้สำหรับ 4 ท่าน อนุญาตให้อยู่ได้ไม่เกิน 8 ท่าน สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำห้องพักอยู่ที่ 500 บาท)*',
    type: 'booking_B'
 }, {
    id: 13,
    img: 'img-resort/เต็นท์.jpg',
    name: 'เต็นท์ 1',
    price: 500,
    description: 'เต็นท์สำหรับลูกค้าที่ต้องการพัก โดยจะมีทั้งหมด 8 ตัว สนใจกดจองได้เลยครับ! สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำเต็นท์อยู่ที่ 500 บาท)*',
    type: 'tent'
 }, {
    id: 14,
    img: 'img-resort/เต็นท์.jpg',
    name: 'เต็นท์ 2',
    price: 500,
    description: 'เต็นท์สำหรับลูกค้าที่ต้องการพัก โดยจะมีทั้งหมด 8 ตัว สนใจกดจองได้เลยครับ! สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำเต็นท์อยู่ที่ 500 บาท)*',
    type: 'tent'
 }, {
    id: 15,
    img: 'img-resort/เต็นท์.jpg',
    name: 'เต็นท์ 3',
    price: 500,
    description: 'เต็นท์สำหรับลูกค้าที่ต้องการพัก โดยจะมีทั้งหมด 8 ตัว สนใจกดจองได้เลยครับ! สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำเต็นท์อยู่ที่ 500 บาท)*',
    type: 'tent'
 }, {
    id: 16,
    img: 'img-resort/เต็นท์.jpg',
    name: 'เต็นท์ 4',
    price: 500,
    description: 'เต็นท์สำหรับลูกค้าที่ต้องการพัก โดยจะมีทั้งหมด 8 ตัว สนใจกดจองได้เลยครับ! สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำเต็นท์อยู่ที่ 500 บาท)*',
    type: 'tent'
 }, {
    id: 17,
    img: 'img-resort/เต็นท์.jpg',
    name: 'เต็นท์ 5',
    price: 500,
    description: 'เต็นท์สำหรับลูกค้าที่ต้องการพัก โดยจะมีทั้งหมด 8 ตัว สนใจกดจองได้เลยครับ! สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำเต็นท์อยู่ที่ 500 บาท)*',
    type: 'tent'
 }, {
    id: 18,
    img: 'img-resort/เต็นท์.jpg',
    name: 'เต็นท์ 6',
    price: 500,
    description: 'เต็นท์สำหรับลูกค้าที่ต้องการพัก โดยจะมีทั้งหมด 8 ตัว สนใจกดจองได้เลยครับ! สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำเต็นท์อยู่ที่ 500 บาท)*',
    type: 'tent'
 }, {
    id: 19,
    img: 'img-resort/เต็นท์.jpg',
    name: 'เต็นท์ 7',
    price: 500,
    description: 'เต็นท์สำหรับลูกค้าที่ต้องการพัก โดยจะมีทั้งหมด 8 ตัว สนใจกดจองได้เลยครับ! สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำเต็นท์อยู่ที่ 500 บาท)*',
    type: 'tent'
 } , {
    id: 20,
    img: 'img-resort/เต็นท์.jpg',
    name: 'เต็นท์ 8',
    price: 500,
    description: 'เต็นท์สำหรับลูกค้าที่ต้องการพัก โดยจะมีทั้งหมด 8 ตัว สนใจกดจองได้เลยครับ! สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.) ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ Facebook : ดาดฟ้ารีสอร์ท... *(ค่ามัดจำเต็นท์อยู่ที่ 500 บาท)*',
    type: 'tent'
 }];

 $(document).ready(() => {
    var html = '';
    for (let i = 0; i < product.length; i++) {
        html += `<div onclick="openProductDetail(${i})" class="product-items ${product[i].type}">
                    <img class="product-img" src="${product[i].img}" alt="">
                    <p style="font-size: 1.2vw;">${product[i].name}</p>
                    <p stlye="font-size: 1vw;">${ numberWithCommas(product[i].price) } THB / คืน</p>
                </div>`;
    }
    $("#productlist").html(html);

 })

 function numberWithCommas(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
 }

 function searchsomething(elem) {
   // console.log('#'+elem.id)
   var value = $('#'+elem.id).val()
   console.log(value)
   var html = '';
   for (let i = 0; i < product.length; i++) {
       if( product[i].name.includes(value) ) {
           html += `<div onclick="openProductDetail(${i})" class="product-items ${product[i].type}">
                   <img class="product-img" src="${product[i].img}" alt="">
                   <p style="font-size: 1.2vw;">${product[i].name}</p>
                   <p stlye="font-size: 1vw;">${ numberWithCommas(product[i].price) } THB</p>
               </div>`;
       }
   }
   if(html == '') {
       $("#productlist").html(`<p>ข้ออภัยครับ ไม่พบข้อมูลที่คุณกำลังหาอยู่ครับ!!!</p>`);
   } else {
       $("#productlist").html(html);
   }
 }

 function searchbooking(param) {
    console.log(param)
    $(".product-items").css('display', 'none')
    if(param == 'all') {
        $(".product-items").css('display', 'block')
    }
    else {
        $("."+param).css('display', 'block')
    }
 }
 

 var productindex = 0;
 function openProductDetail(index) {
    productindex = index;
    console.log(productindex)
    $("#modalDesc").css('display', 'flex')
    $("#mdd-img").attr('src', product[index].img);
    $("#mdd-name").text(product[index].name)
    $("#mdd-price").text( numberWithCommas(product[index].price) + ' THB / คืน')
    $("#mdd-desc").text(product[index].description)
 }

 function closeModal() {
    $(".modal").css('display','none')
 }

</script>
</body>
</html>