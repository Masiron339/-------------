<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ล็อกอิน เข้าสู่ระบบ</title>
  </head>

  <body>
    <form class="container" method="post">
    <img src="img-resort/logo.jpg" width="90px" style="border-radius: 20%;">
      <h1>ล็อกอินเข้าสู่ระบบ ดาดฟ้ารีสอร์ท</h1>
        <input type="text" name="username" class="textbox" required minlength="3" placeholder="ชื่อผู้ใช้งาน">
        <input type="password" name="password" class="textbox" required minlength="3" placeholder="password">

              <p>ยังไม่มีบัญชีผู้ใช้งานระบบ?</p>
              <a href="register.php" class="register">สมัครสมาชิก</a>

        <button type="submit" class="login"></button>
    </form>
  </body>
</html>  
 
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap');
      *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Roboto', sans-serif;
      }

      body{
        height: 100vh;
        width: 100%;
        background-image: linear-gradient(#3498db,#2ecc71, #1abc9c);
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .container{
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      h1{
        margin: 20px;
        color: black;
      }

      p{
        margin: 10px;
      }

      a{
        margin: 10px;
      }

      input{
        border: none;
        height: 50px;
        width: 250px;
        margin: 10px 0;
        padding: 0 10px;
        font-size: 1rem;
        outline: none;
        text-align: center;
        border-radius: 5px;
        transition: .5s;
        cursor: pointer;
      }

      .textbox{
        color: white;
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.4);
      }

      .textbox::placeholder{
        color: white;
      }

      .textbox:hover,
      .textbox:focus {
        background: white; 
        width: 350px;
        color: #1abc9c;
      }

.login {
  position: relative;
  background-color: transparent;
  color: #e8e8e8;
  font-size: 17px;
  font-weight: 600;
  border-radius: 10px;
  width: 150px;
  height: 60px;
  border: none;
  text-transform: uppercase;
  cursor: pointer;
  overflow: hidden;
  box-shadow: 0 10px 20px rgba(51, 51, 51, 0.2);
  transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
}
.login::before {
  content: "ล็อกอินเข้าสู่ระบบ";
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
  pointer-events: none;
  background: linear-gradient(135deg,#7b4397,#dc2430 );
  transform: translate(0%,90%);
  z-index: 99;
  position: relative;
  transform-origin: bottom;
  transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
}
.login::after {
  content: "LOG IN";
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #333;
  width: 100%;
  height: 100%;
  pointer-events: none;
  transform-origin: top;
  transform: translate(0%,-100%);
  transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
}
.login:hover::before {
  transform: translate(0%,0%);
}
.login:hover::after {
  transform: translate(0%,-200%);
}
.login:focus {
  outline: none;
}
.login:active {
  scale: 0.95;
}

    </style>
 
 <?php
 
    if(isset($_POST['username']) && isset($_POST['password']) ){
    
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
 
    require_once 'connect.php';
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
 
    
      $stmt = $conn->prepare("SELECT id, name, surname FROM tbl_member WHERE username = :username AND password = :password");
      $stmt->bindParam(':username', $username , PDO::PARAM_STR);
      $stmt->bindParam(':password', $password , PDO::PARAM_STR);
      $stmt->execute();
 
      if($stmt->rowCount() == 1){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['surname'] = $row['surname'];
 
          header('Location: index.php'); 
      }else{
 
         echo '<script>
                       setTimeout(function() {
                        swal({
                            title: "เกิดข้อผิดพลาด",
                             text: "Username หรือ Password ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง",
                            type: "warning"
                        }, function() {
                            window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
                        });
                      }, 1000);
                  </script>';
              $conn = null;
            }
    }
?>