<?php
session_start();
if($_SESSION['uid']!=session_id())
{
	header("location:login.php");
}
?>
<?php include"umenu.php"; ?>
<div id="body">
<?php
include"connection.php";
$q="select * from bidhistory".$id;
		$sq=mysqli_query($connection,$q);
	if($sq)
	{	
		if(mysqli_fetch_array($sq)>0)
		{
		$sq=mysqli_query($connection,$q);
		echo'<table cellpadding="20%"><tr bgcolor="red" style="color:white"><th>Bid ID</th><th>Product ID</th><th>Product Name</th><th>Artist</th><th>Base Cost</th><th>Category</th><th>Bid Amount</th><th>Photo</th><th>Status</th></tr>';
			while($r=mysqli_fetch_array($sq))
			{
				
				echo '<tr><th>'.$r['bID'].'</th>';
				echo '<th>'.$r['pID'].'</th>';
				echo '<th>'.$r['bname'].'</th>';
				echo '<th>'.$r['bartist'].'</th>';
				echo '<th>'.$r['bbaseCost'].'</th>';
				echo '<th>'.$r['bcategory'].'</th>';
				echo '<th>'.$r['bidPlaced'].'</th>';
				echo '<th><img src="'.$r['bphoto'].'" width="100" height="100"></th>';
				echo '<th>'.$r['status'].'</th>';
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
?>
</div>