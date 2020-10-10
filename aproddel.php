<?php
session_start();
if($_SESSION['aid']!=session_id())
{
	header("location:login.php");
}
?>

<?php
include"amenu.php";
?>

<?php 
if(isset($_GET['pid']))
{
$pid=$_GET['pid'];
		
		include"connection.php";
		
		$q="delete from product where pid='".$pid."'";
		$sq=mysqli_query($connection,$q);
		if($sq)
		{
					header("location:product.php");
		}
		else
		{
			echo mysqli_error($connection);
		}
}
else
{
	header("location:admin.php");
}
?>