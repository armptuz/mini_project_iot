<?php
 	session_start();
	require_once "config.php";
//	include("database.php"); 
	$sql = "UPDATE d_water SET water='".$_GET['water']."' WHERE d_water.ID = 1";
	
	$query = mysqli_query($mysqli,$sql)
			or die('query insert : '.mysqli_error($mysqli));
		
    $sql = "UPDATE d_temp SET temp='".$_GET['temp']."' WHERE d_temp.ID = 1";
	$query = mysqli_query($mysqli,$sql)
			or die('query insert : '.mysqli_error($mysqli));
			
    $sql = "UPDATE d_humidity SET humidity='".$_GET['humidity']."' WHERE d_humidity.ID = 1";
	$query = mysqli_query($mysqli,$sql)
			or die('query insert : '.mysqli_error($mysqli));
		
	if($query)
	{
		echo	"	<h1> Add  Success! <h1> 	";
	}
	else
	{
	 	echo	"	<h1> Add  Error! <h1> 	";
 	}
	
?>
