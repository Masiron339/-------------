<?php

include 'config.php';
session_start();
$id = $_SESSION['id'];

if(isset($_POST['update_profile'])){

   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_surname = mysqli_real_escape_string($conn, $_POST['update_surname']);
   $update_username = mysqli_real_escape_string($conn, $_POST['update_username']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_phone = mysqli_real_escape_string($conn, $_POST['update_phone']);

   mysqli_query($conn, "UPDATE `tbl_member` SET name = '$update_name', surname = '$update_surname', username = '$update_username', email = '$update_email', phone = '$update_phone' WHERE id = '$id'") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'รหัสผ่านเก่าไม่ถูกต้อง!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'ยืนยันรหัสผ่านไม่ถูกต้อง!';
      }else{
         mysqli_query($conn, "UPDATE `tbl_member` SET password = '$confirm_pass' WHERE id = '$id'") or die('query failed');
         $message[] = 'อัปเดตรหัสผ่านสำเร็จ!';
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'ขนาดรูปภาพมีความกว้างเกินไป';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `tbl_member` SET image = '$update_image' WHERE id = '$id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'อัปเดตรูปภาพสำเร็จ';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style1.1.css">

</head>
<body>
   
<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `tbl_member` WHERE id = '$id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <span>ชื่อ :</span>
            <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box">
            <span>นามสกุล :</span>
            <input type="surname" name="update_surname" value="<?php echo $fetch['surname']; ?>" class="box">
            <span>username :</span>
            <input type="text" name="update_username" value="<?php echo $fetch['username']; ?>" class="box">
            <span>อีเมล :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>หมายเลขโทรศัพท์ :</span>
            <input type="phone" name="update_phone" value="<?php echo $fetch['phone']; ?>" class="box">
            <span>อัปเดตรูปภาพ :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
         </div>

         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>รหัสผ่านเก่า :</span>
            <input type="password" name="update_pass" placeholder="กรุณาใส่รหัสผ่านเก่า" class="box">
            <span>รหัสผ่านใหม่ :</span>
            <input type="password" name="new_pass" placeholder="กรุณาใส่รหัสผ่านใหม่" class="box">
            <span>ยืนยันรหัสผ่านใหม่ :</span>
            <input type="password" name="confirm_pass" placeholder="ยืนยันรหัสผ่านใหม่" class="box">
         </div>
      </div>

      <input type="submit" value="อัปเดตข้อมูล" name="update_profile" class="btn">
      <a href="home1.php" class="delete-btn">กลับสู่หน้าหลัก</a>
   </form>

</div>

</body>
</html>