<?php
session_start();
if(isset($_SESSION['uid']))
{
	header("location:home.php");
}
?>
<?php
if($_SESSION['rd']==session_id())
{
	include"connection.php";
	$e=$_SESSION['e'];
	$q0="select * from user where email='".$e."'";
	$sq0=mysqli_query($connection,$q0);
	if($sq0)
	{
		if(mysqli_fetch_array($sq0)>0)
		{
			$sq0=mysqli_query($connection,$q0);
			while($r=mysqli_fetch_array($sq0))
			{
				$id=$r['id'];
			}
		}
	}
	$q="create table sell".$id."(productid int(5) not null,
							sname varchar(90) not null,
							sartist varchar(50) not null ,
							sbaseCost int(15) not null,
							scategory varchar(300) not null,
							sphoto varchar(100) not null,
							primary key(productid))";
							
				$sq=mysqli_query($connection,$q);
				if($sq)
				{
					echo ' table created';
				}
				else
				{
					echo mysqli_error($connection);
				}
	$q0="create table bidHistory".$id."(bID int(5) not null,
							pID int(5) not null,
							bname varchar(90) not null,
							bartist varchar(50) not null ,
							bbaseCost int(15) not null,
							bcategory varchar(300) not null,
							bphoto varchar(100) not null,
							bidPlaced int(10) not null,
							status varchar(20) default'UnderReview')";
							
				$sq0=mysqli_query($connection,$q0);
				if($sq0)
				{
					echo ' table created';
				}
				else
				{
					echo mysqli_error($connection);
				}
	
	header("location:registered.php");
}
?>