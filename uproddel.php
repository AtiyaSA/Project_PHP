<?php
session_start();
if($_SESSION['uid']!=session_id())
{
	header("location:login.php");
}
?>

<?php
include"umenu.php";
?>

<?php 
if(isset($_GET['pid']))
{
	$pid=$_GET['pid'];
		
	include"connection.php";
	
	$q="delete from sell".$id." where productid=".$pid;
	$sq=mysqli_query($connection,$q);
	if($sq)
	{
				header("location:productShow.php");
	}
	else
	{
		echo mysqli_error($connection);
	}


	$q1="delete from product where pid=".$pid;
	$sq1=mysqli_query($connection,$q1);
	if($sq1)
	{
				header("location:productShow.php");
	}
	else
	{
		echo mysqli_error($connection);
	}
    
}
else
{
	header("location:productShow.php");
}
?>