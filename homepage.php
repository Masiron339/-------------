<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Home Page</title>
</head>

<body>
<div class="container bg">
  <div class="navBar">
    <div class="logo">
      <img src="img-resort/logo.jpg" width="150px"  style="margin-top: 150px">;
      <style>
        img {
            height: 150px;
            border-radius: 50%;
        }
      </style>
    </div>
    <ul>
      <li><a href="homepage.php">Home</a></li>
      <li><a href="login.php">Log In</a></li>
    </ul>
  </div>

  <div class="content">
    <div class="phuket" style="width:50%;">
      <div class="tnx">
        <h2><i class="fas fa-map-marker-alt"></i> Welcome To Thailand Resort</h2>
      </div>
      <div class="txt">
        <h1>ดาดฟ้ารีสอร์ท</h1>
        <h1>จังหวัดปัตตานี</h1>
      </div>
      <p>ดาดฟ้ารีสอร์ท ยินดีต้อนรับครับ 🙌 บ้านพักริมทะเล บรรยากาศร่มรื่น นั่งปิ้งย่างกันอย่างสบายใจ 
        แถมมีดาดฟ้าให้มองวิวชายหาดและพระอาทิตย์จากมุมสูง 🏖
        เหมาะสำหรับการรวมตัวของครอบครัวและผองเพื่อน
        รายละเอียดห้องพักตามรูปข้างล่างได้เลยค่ะ
        สอบถามห้องว่างและสำรองห้องพัก (เวลา 08.00-20.00น.)
        065-430-1635 และ 086-958-5578</p>
    </div>
    <div class="card" style="width:50%;">
      
        <div class="box1">
          <h2>ชายหาด</h2>
        </div>
      
        <div class="box2">
          <h2>ตะวันตก</h2>
        </div>
      
        <div class="box3">
          <h2 class="tnt">เต็นท์</h2>
        </div>
      
        <div class="box4">
          <h2 class="tnt">รีสอร์ท</h2>
        </div>
      
    </div>
  </div>
</div>


<style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: arial;
}
* a {
  text-decoration: none;
}
* li {
  list-style: none;
}
.container {
  min-height: 100vh;
  padding-bottom: 50px;
  margin: 0 auto;
  position: relative;
}
.bg {
  position: relative;
  width: 100%;
  height: 100%;
}
.bg::after {
  content: "";
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  position: absolute;
  z-index: -1;
  filter: brightness(45%);
  background-image: url("https://images.unsplash.com/photo-1504214208698-ea1916a2195a?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1500&q=80");
  background-size: cover;
  background-position: center;
}
.navBar {
  display: flex;
  width: 85%;
  justify-content: space-between;
  margin: 0 auto;
  align-items: center;
  height: 15vh;
}
.navBar ul {
  display: flex;
  align-items: center;
}
.navBar ul li {
  padding: 0 25px;
}
.navBar ul li a {
  font-size: 1rem;
  color: #fff;
  font-weight: 400;
  letter-spacing: 1.5px;
}
.navBar .logo a {
  font-size: 2.3rem;
  color: #fff;
}
.content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 85%;
  position: absolute;
  top: 60%;
  left: 50%;
  transform: translate(-50%, -50%);
  align-items: center;
}
.phuket {
  color: #fff;
  padding: 25px;
}
.card {
  display: grid;
  grid-template-columns: auto auto;
  grid-gap: 20px;
}
.card h2 {
  color: #fff;
  position: absolute;
  bottom: 15px;
  left: 20px;
  font-size: 1.6rem;
  letter-spacing: 1px;
}

.card h2.tnt{
  color: black;
  position: absolute;
  bottom: 15px;
  left: 20px;
  font-size: 1.6rem;
  letter-spacing: 1px;
}
.card .box1,
.box2,
.box3,
.box4 {
  width: 90%;
  height: 220px;
  background-position: center;
  background-size: cover;
  position: relative;
  border-radius: 25px;
  cursor: pointer;
}
.box1 {
  background-image: url("img-resort/sea.jpg");
}
.box2 {
  background-image: url("img-resort/sea2.jpg");
}
.box3 {
  background-image: url("img-resort/tentwall.jpg");
}
.box4 {
  background-image: url("img-resort/resort.jpg");
}
.phuket h2 {
  font-size: 2rem;
  letter-spacing: 2.8px;
}
.text {
  display: flex;
  justify-content: flex-start;
  align-items: center;
}
.txt h1 {
  font-size: 4rem;
}
.phuket p {
  opacity: 0.4;
}
.tnx h2 i {
  color: #fd7e13;
}
.card div {
  transition: 0.5s;
}
.card div:hover {
  transition: 0.3s;
  transform: translateY(-10px);
  box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3), 0 15px 12px rgba(0, 0, 0, 0.22);
}

</style>
</body>
</html>