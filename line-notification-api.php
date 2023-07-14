<?php

 echo '
 <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$lineid = $_POST['lineid'];
$mesg = $_POST['mesg'];

$message = $mesg."\n".'จาก : '.$name."\n".'อีเมล์ : '.$email."\n".'Phone : '.$phone."\n".'Line ID : '.$lineid;

if($name<>"" || $email <> "" || $mesg <> "") {
	
	sendlinemesg();

	header('Content-Type: text/html; charset=utf-8');
	$res = notify_message($message);
	echo "<center>ส่งข้อความเรียบร้อยแล้ว</center>";
	echo '<script>
	setTimeout(function() {
	 swal({
		 title: "ส่งข้อความสำเร็จ",
		  text: "ข้อความของคุณจะถูกส่งเข้า ระบบ Line notification",
		 type: "success"
	 }, function() {
		 window.location = "line-notification.php"; //หน้าที่ต้องการให้กระโดดไป
	 });
   }, 1000);
</script>';


} else {
	echo "<center>Error : กรุณากรอกข้อมูลให้ครบถ้วน</center>";
	echo '<script>
             setTimeout(function() {
              swal({
                  title: "กรุณากรอกข้อมูลให้ครบถ้วน!! ",  
                  text: "ไม่สามารถส่งข้อความได้ เนื่องจากข้อมูลของคุณไม่ครบถ้วน",
                  type: "warning"
              }, function() {
                  window.location = "line-notification.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
      </script>';
}

function sendlinemesg() {
	
    define('LINE_API',"https://notify-api.line.me/api/notify");
	define('LINE_TOKEN','at9eQkrEn2dpU610RfXV6jRKowb2FjThhEzpvi3I6lL');

	function notify_message($message){

		$queryData = array('message' => $message);
		$queryData = http_build_query($queryData,'','&');
		$headerOptions = array(
			'http'=>array(
				'method'=>'POST',
				'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
						."Authorization: Bearer ".LINE_TOKEN."\r\n"
						."Content-Length: ".strlen($queryData)."\r\n",
				'content' => $queryData
			)
		);
		$context = stream_context_create($headerOptions);
		$result = file_get_contents(LINE_API,FALSE,$context);
		$res = json_decode($result);
		return $res;

	}

}

?>