<? //== หน้า 1
session_start();
$customer_id = rand(10000, 99999);
$_SESSION["customer_id"]=$customer_id;
echo $customer_id;
?>