<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>สมัครสมาชิก</title>
  </head>

  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-8"> <br><br><br>
          <h4>สมัครสมาชิกเพื่อเข้าสู่ระบบ</h4>
          <br>
          <form action="" method="post">

            <div class="mb-2">
                <div class="col-sm-9">
                <input type="text" name="name" class="form-control" required minlength="3" placeholder="ชื่อ">
              </div>
              </div>

              <div class="mb-2">
                <div class="col-sm-9">
                  <input type="text" name="surname" class="form-control" required minlength="3" placeholder="นามสกุล">
                </div>
                </div>

                <div class="mb-2">
                <div class="col-sm-9">
                  <input type="text" name="username" class="form-control" required minlength="3" placeholder="ชื่อผู้ใช้งาน">
                </div>
                </div>

                <div class="mb-2">
                <div class="col-sm-9">
                    
                  <input type="text" name="email" class="form-control" required minlength="3" placeholder="อีเมล">
                </div>
                </div>

                <div class="mb-2">
                <div class="col-sm-9">
                  <input type="int" name="phone" class="form-control" required minlength="3" placeholder="เบอร์โทรศัพท์">
                </div>
                </div>

                <div class="mb-3">
                <div class="col-sm-9">
                  <input type="password" name="password" class="form-control" required minlength="3" placeholder="Password">
                </div>
                </div>

                <br>
                <div class="d-grid gap-2 col-sm-9 mb-3">
                    <button type="submit" class="btn btn-primary">สมัครสมาชิก</button>
                </div>

                <div class="mb-4">
                <div class="col-sm-9">
                    <p>มีบัญชีในระบบอยู่แล้ว!</p>
                    <a href="login.php" class="register-link">กลับสู่หน้าล็อกอิน</a>
                </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </body>
    </html>  

    <style>
      body{
        display: flex;
        background-image: linear-gradient(#3498db,#2ecc71, #1abc9c);
      }
      p{
        text-align: center;
      }
      div.mb-4 {
        text-align: center;
      }
    </style>
 
 
<?php

    if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']) ){
    
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
 
    require_once 'connect.php';
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = sha1($_POST['password']);
 
      $stmt = $conn->prepare("SELECT id FROM tbl_member WHERE username = :username");
      $stmt->execute(array(':username' => $username));
      
      if($stmt->rowCount() > 0){
          echo '<script>
                       setTimeout(function() {
                        swal({
                            title: "Username ซ้ำ !! ",  
                            text: "กรุณาสมัครใหม่อีกครั้ง",
                            type: "warning"
                        }, function() {
                            window.location = "register.php"; //หน้าที่ต้องการให้กระโดดไป
                        });
                      }, 1000);
                </script>';
      }else{ 
              $stmt = $conn->prepare("INSERT INTO tbl_member (name, surname, username, email, phone, password)
              VALUES (:name, :surname, :username, :email, :phone, :password)");
              $stmt->bindParam(':name', $name, PDO::PARAM_STR);
              $stmt->bindParam(':surname', $surname , PDO::PARAM_STR);
              $stmt->bindParam(':username', $username , PDO::PARAM_STR);
              $stmt->bindParam(':email', $email , PDO::PARAM_STR);
              $stmt->bindParam(':phone', $phone , PDO::PARAM_STR);
              $stmt->bindParam(':password', $password , PDO::PARAM_STR);
              $result = $stmt->execute();
              if($result){
                  echo '<script>
                       setTimeout(function() {
                        swal({
                            title: "สมัครสมาชิกสำเร็จ",
                            text: "กรุณา Login เข้าสู่ระบบต่อไป...",
                            type: "success"
                        }, function() {
                            window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
                        });
                      }, 1000);
                  </script>';
              }else{
                 echo '<script>
                       setTimeout(function() {
                        swal({
                            title: "เกิดข้อผิดพลาด",
                            type: "error"
                        }, function() {
                            window.location = "register.php"; //หน้าที่ต้องการให้กระโดดไป
                        });
                      }, 1000);
                  </script>';
              }
              $conn = null; 
        } 
    } 
?>