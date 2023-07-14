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
                title: "คุณไม่มีสิทธิ์ใช้งานหน้านี้ กรุณาเข้าสู่ระบบก่อนครับ!",
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Line Notificate</title>
</head>


<style>
    body{
        background-color: #2ecc71;
    }
</style>


<body>
<div class="container">
  <form action="line-notification-api.php" name="line-notification" method="POST">

    <br>
    <h1><i class="fa-brands fa-line" style="color: green;"></i> Line Notificate</h1><br>

    <div class="mb-3">
        <label for="name" class="form-label">ชื่อ - นามสกุล</label>
        <input type="text" class="form-control" name="name" aria-describedby="name">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" aria-describedby="email">
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">หมายเลขโทรศัพท์</label>
        <input type="number" class="form-control" name="phone" aria-describedby="phone">
    </div>
    <div class="mb-3">
        <label for="lineid" class="form-label">LINE ID</label>
        <input type="text" class="form-control" name="lineid" aria-describedby="lineid">
    </div>
    <div class="mb-3">
        <label for="mesg" class="form-label">ข้อความ</label>
        <input type="mesg" class="form-control" name="mesg" aria-describedby="mesg"  style="height:100px;">
    </div>
    
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    <a href="index.php" class="btn btn-danger">กลับสู่หน้าหลัก</a>
    
  </form>
</div>
</body>
</html>