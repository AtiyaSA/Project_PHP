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

		include"connection.php";
		
		$q="select * from product";
		$sq=mysqli_query($connection,$q);
	if($sq)
	{	
		if(mysqli_fetch_array($sq)>0)
		{
		$sq=mysqli_query($connection,$q);
		echo'<table cellpadding="20%"><tr bgcolor="red" style="color:white">
		<th>Pid</th><th>Product Name</th><th>Artist</th><th>Base Cost</th>
		<th>Category</th><th>Uploaded By</th><th>Uploader ID</th><th>Total Bids</th><th>Recent Bid</th><th>Photo</th><th>Delete</th></tr>';
			while($r=mysqli_fetch_array($sq))
			{
				echo '<tr><th>'.$r['pid'].'</th>';
				echo '<th>'.$r['pname'].'</th>';
				echo '<th>'.$r['partist'].'</th>';
				echo '<th>'.$r['pbase'].'</th>';
				echo '<th>'.$r['pcategory'].'</th>';
				echo '<th>'.$r['uploadedBy'].'</th>';
				echo '<th>'.$r['uploaderID'].'</th>';
				echo '<th>'.$r['totalBids'].'</th>';
				echo '<th>'.$r['recentBid'].'</th>';
				echo '<th><img src="'.$r['pphoto'].'" width="100" height="100"></th>';
				$pid=$r['pid'];
				echo '<th><a href="aproddel.php?pid='.$pid.'">delete</a></th><tr>';
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