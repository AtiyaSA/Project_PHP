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
	$q="select * from bid".$pid;
	$sq=mysqli_query($connection,$q);
	if($sq)
	{	
		if(mysqli_fetch_array($sq)>0)
		{
		$sq=mysqli_query($connection,$q);
		echo'<table cellpadding="20%"><tr bgcolor="red" style="color:white">
		<th>Bid Id</th><th>User ID</th><th>User Name</th><th>User Email</th>
		<th>Bid Amount</th><th>Accept</th></tr>';
			while($r=mysqli_fetch_array($sq))
			{
				
				
				echo '<tr><th>'.$r['bid'].'</th>';
				$bid=$r['bid'];
				echo '<th>'.$r['userID'].'</th>';
				$userID=$r['userID'];
				echo '<th>'.$r['userName'].'</th>';
				echo '<th>'.$r['userEmail'].'</th>';
				echo '<th>'.$r['bidAmount'].'</th>';
				echo '<th><a href="uaccept.php?bid='.$bid.'&pid='.$pid.'&userID='.$userID.'">Accept</a></th><tr>';
			}
			echo'</table>';
		}		
		else
		{
		echo 'no record found';
		}
	}
	else
	{
		echo mysqli_error($connection);
	}
}
?>