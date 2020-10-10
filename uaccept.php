<?php
session_start();
if($_SESSION['uid']!=session_id())
{
	header("location:login.php");
}
?>
<?php include"umenu.php"; ?>
<?php
$bid=$_GET['bid'];
$pid=$_GET['pid'];
$userID=$_GET['userID'];
include"connection.php";
$qq="select * from bidhistory".$userID." where  bID=".$bid;
$sqq=mysqli_query($connection,$qq);
if($sqq)
{
	$sqq=mysqli_query($connection,$qq);
	while($r=mysqli_fetch_array($sqq))
	{
		
		foreach($r as $key=>$value)
		{
			if(is_string($key))
				$bb[$key]=$value;
		}	
	}
	if ($bb['status']=='Accepted')
	{
		echo'<br><br>You have already accepted the bid. Click <a href="productShow.php">here</a> to go back';
	}
	else
	{
		echo $pid;
		$qqq="select userID from bid".$pid;
		$sqqq=mysqli_query($connection,$qqq);
		if ($sqqq)
		{
			$sqqq=mysqli_query($connection,$qqq);
			echo $bid.'<br>';
			if(mysqli_fetch_array($sqqq)>0)
			{
			while($r=mysqli_fetch_array($sqqq))
			{
include"connection.php";
				$q11="update bidhistory".$r[0]." set status='Declined' where pID='".$pid."'";
				$sq11=mysqli_query($connection,$q11);
				if(!$sq11)
				{
					echo mysqli_error($connection);
				}
			}
			}
			else
			{
				echo 'no';
			}
			$query="update bidhistory".$userID." set status='Accepted' where bid=".$bid;
			$squery=mysqli_query($connection,$query);
			if(!$squery)
			{
				echo mysqli_error($connection);
			}
			$query1="delete from bid".$pid." where bid!=".$bid;
			$squery1=mysqli_query($connection,$query1);
			if ($squery1)
			{
				//header("location:productShow.php");
			}
			else
			{
				echo mysqli_error($connection);
			}
		}
		else
		{
			echo mysqli_error($connection);
		}
	}
}
else
{
	echo mysqli_error($connection);
}	
?>