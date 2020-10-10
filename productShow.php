<?php
session_start();
if($_SESSION['uid']!=session_id())
{
	header("location:login.php");
}
?>
<?php include"umenu.php"; ?>

<?php
include"connection.php";
$q="select * from sell".$id;
		$sq=mysqli_query($connection,$q);
	if($sq)
	{	
		if(mysqli_fetch_array($sq)>0)
		{
		$sq=mysqli_query($connection,$q);
		echo'<table cellpadding="20%"><tr bgcolor="red" style="color:white">
		<th>Pid</th><th>Product Name</th><th>Artist</th><th>Base Cost</th>
		<th>Category</th><th>Photo</th><th>Update</th><th>Delete</th></tr>';
			while($r=mysqli_fetch_array($sq))
			{
				
				$pid=$r['productid'];
				echo '<tr><th><a href="bid.php?pid='.$pid.'">'.$r['productid'].'</a></th>';
				echo '<th>'.$r['sname'].'</th>';
				echo '<th>'.$r['sartist'].'</th>';
				echo '<th>'.$r['sbaseCost'].'</th>';
				echo '<th>'.$r['scategory'].'</th>';
				echo '<th><img src="'.$r['sphoto'].'" width="100" height="100"></th>';
				echo '<th><a href="uprodup.php?pid='.$pid.'">Update</a></th>';
				echo '<th><a href="uproddel.php?pid='.$pid.'">Delete</a></th><tr>';
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