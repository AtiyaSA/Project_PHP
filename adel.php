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
if(isset($_GET['id']))
{
$id=$_GET['id'];
		
		include"connection.php";
		
		$q="delete from user where id=".$id;
		$sq=mysqli_query($connection,$q);
		if($sq)
		{
			$q1="delete from product where uploaderID=".$id;
			$sq1=mysqli_query($connection,$q1);
			if(!$sq1)
			{
				echo mysqli_error($connection);
			}
			//header("location:admin.php");
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