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


<?php

include 'config.php';
$id = $_SESSION['id'];

if(!isset($id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($id);
   session_destroy();
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- custom css file link  -->
   <link rel="stylesheet" href="style1.1.css">

</head>
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

<style>
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
  *::-webkit-scrollbar {
  display: none;
  }
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
</style>
   
<div class="container">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `tbl_member` WHERE id = '$id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
      <h3>ยินดีต้อนรับ!!!</h3>
      <h3><?php echo $fetch['username']; ?></h3>
      <a href="update_profile.php" class="btn">อัปเดต โปรไฟล์</a>
      <a href="logout.php" class="btn btn-danger" onclick="return confirm('ยืนยันการออกจากระบบ');">ออกจากระบบ</a>
   </div>

</div>

</body>
</html>