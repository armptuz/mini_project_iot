<?php
//1. �������� database: 
include('config.php');  //����������͡Ѻ database �����������ҧ����͹˹�ҹ��
 
//2. query �����Ũҡ���ҧ tb_member: 
$query = "SELECT * FROM `d_temp` WHERE d_temp.ID=1" or die("Error:" . mysqli_error()); 
//3.�红����ŷ�� query �͡�����㹵���� result . 
$result = mysqli_query($mysqli, $query); 
//4 . �ʴ������ŷ�� query �͡�� ������ҧ㹡�èѴ������: 
while($row = mysqli_fetch_array($result)) { 
  echo $row["temp"]; 
    $data = $row["temp"]; 

  echo '<script type="text/javascript">';
  echo "var data2 = '$data2';"; // �觤�� $data �ҡ PHP ��ѧ����� data �ͧ Javascript
  echo '</script>';
}

//5. close connection
mysqli_close($mysqli);
?>