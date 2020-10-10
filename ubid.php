<?php
session_start();
if($_SESSION['uid']!=session_id())
{
	header("location:login.php");
}
?>
<?php include"umenu.php"; ?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<style>
.r1 {position:absolute; height:55%;overflow:hidden;top:10%; border-radius:50px;}
.r2 {position:absolute; background-color:white; height:55%; text-align:center; line-height:3vw;font-size:2vw;border-radius:50px;top:10%;}
p {font-size:1.5vw;}
input{width:35%; height:10%; line-height:2px;}
</style>

<?php
$bid=$bids='';
$id=$_SESSION['id'];
$name=$_SESSION['name'];
function checkbid()
{
	$p=trim($_POST['bid']);
	$pc='/^[0-9]{1,10}$/';
	if(preg_match($pc,$p))
	{
		return 'y';
	}
	else
	{
		return 'n';
	}
}
if(isset($_POST['s']))
{
	$bid=$_POST['bid'];
	$pid=$_GET['pid'];
	if(checkbid()=='n')
	{
		$bids='***check the entered amount.';
	}
	else
	{
		include"connection.php";
		$q0="insert into bid".$pid."(userID,userName,userEmail,bidAmount) values('".$id."','".$name."','".$_SESSION['email']."','".$bid."')";
		$sq0=mysqli_query($connection,$q0);
		if ($sq0)
		{
			
			$q1="select * from product where pid=".$pid;
			$sq1=mysqli_query($connection,$q1);
			if ($sq1)
			{
				$sq1=mysqli_query($connection,$q1);
				while($r=mysqli_fetch_array($sq1))
				{
					foreach($r as $key=>$value)
					if(is_string($key))
					{
						$b[$key]=$value;
					}
				}
				
			}
			$tb=$b['totalBids']+1;
			$q2="update product set totalBids='".$tb."' ,recentBid='".$bid."' where pid='".$pid."'";
			
			$sq2=mysqli_query($connection,$q2);
			if ($sq2)
			{
			
				$q3="select * from bid".$pid;
				$sq3=mysqli_query($connection,$q3);
				if($sq3)
				{
					$sq1=mysqli_query($connection,$q3);
					while($r=mysqli_fetch_array($sq3))
					{
						$bidID=$r['bid'];
					}
					$q4="insert into bidhistory".$id."(bID,pID,bname,bartist,bcategory,bbaseCost,bphoto,bidPlaced) values ('".$bidID."','".$pid."','".$b['pname']."','".$b['partist']."','".$b['pcategory']."','".$b['pbase']."','".$b['pphoto']."','".$bid."')";
					$sq4=mysqli_query($connection,$q4);
					if($sq4)
					{
						$bids='<br>You have successfully placed your bid.';
						$bid='';
					}
					else
					{
						echo mysqli_error($connection);
					}
				}
				else
				{
					
				}
				$bid='';
				
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
?>

<?php
if(isset($_GET['pid']))
{
	$pid=$_GET['pid'];
	include"connection.php";
	$q="select * from product where pid=".$pid;
	$sq=mysqli_query($connection,$q);
	if($sq)
	{
		if(mysqli_fetch_array($sq)>0)
		{
				if ($sq)
				{
					$sq=mysqli_query($connection,$q);
					while($r=mysqli_fetch_array($sq))
					{
						foreach($r as $key=>$value)
						if(is_string($key))
							$p[$key]=$value;
					}
				}
		}
		else
		{
			echo mysqli_error($connection);
		}
	}
	echo'<div class="container">
			<div class="row">
				<div class="col-md-4 r1" >
					<img src="'.$p['pphoto'].'" width="100%" height="100%" >
				</div>
				<div class="col-md-4 offset-md-5 r2">
					<b>'.$p['pname'].' by '.$p['partist'].'</b>
					<p>Uploaded by: '.$p['uploadedBy'].'<br>
					Base Amount [in Rs]: '.$p['pbase'].'<br></p>
					<form action="" method="POST">
					<p>Enter bid amount [in Rs] :&nbsp;<input type="text" name="bid" value="'.$bid.'">
					<span name="bids">'.$bids.'</span><br><br>
					<input type="submit" name="s"></form></p>
					<br><br>
				</div>
			</div>
		</div>';

}
?>