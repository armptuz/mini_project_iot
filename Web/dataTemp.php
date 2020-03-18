<?php
//1. เชื่อมต่อ database: 
include('config.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
 
//2. query ข้อมูลจากตาราง tb_member: 
$query = "SELECT * FROM `d_temp` WHERE d_temp.ID=1" or die("Error:" . mysqli_error()); 
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
$result = mysqli_query($mysqli, $query); 
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 
while($row = mysqli_fetch_array($result)) { 
  echo $row["temp"]; 
    $data = $row["temp"]; 

  echo '<script type="text/javascript">';
  echo "var data2 = '$data2';"; // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
  echo '</script>';
}

//5. close connection
mysqli_close($mysqli);
?>