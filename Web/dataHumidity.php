<?php
//1. เชื่อมต่อ database: 
include('config.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
 
//2. query ข้อมูลจากตาราง tb_member: 
$query = "SELECT * FROM `d_humidity` WHERE d_humidity.ID=1" or die("Error:" . mysqli_error()); 
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
$result = mysqli_query($mysqli, $query); 
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 
while($row = mysqli_fetch_array($result)) { 
  echo $row["humidity"]; 
    $data = $row["humidity"]; 

  echo '<script type="text/javascript">';
  echo "var data3 = '$data3';"; // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
  echo '</script>';
}

//5. close connection
mysqli_close($mysqli);
?>