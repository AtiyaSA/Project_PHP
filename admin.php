
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
		
		$q="select * from user";
		$sq=mysqli_query($connection,$q);
	if($sq)
	{	
		if(mysqli_fetch_array($sq)>0)
		{
		$sq=mysqli_query($connection,$q);
		echo'<table cellpadding="20%"><tr bgcolor="red" style="color:white">
		<th>ID</th><th>Name</th><th>Email</th><th>Phone</th>
		<th>D.O.B</th><th>Photo</th><th>Delete</th></tr>';
			while($r=mysqli_fetch_array($sq))
			{
				echo '<tr><th>'.$r['id'].'</th>';
				echo '<th>'.$r['name'].'</th>';
				echo '<th>'.$r['email'].'</th>';
				echo '<th>'.$r['phone'].'</th>';
				echo '<th>'.$r['dob'].'</th>';
				echo '<th><img src="'.$r['photo'].'" width="100" height="100"></th>';
				$id=$r['id'];
				
				echo '<th><a href="adel.php?id='.$id.'">delete</a></th><tr>';
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