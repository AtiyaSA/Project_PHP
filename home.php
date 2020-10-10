<?php
session_start();
if(isset($_SESSION['uid']))
{
	include"umenu.php";
	
}
elseif(isset($_SESSION['aid']))
{
	include"amenu.php";
}
else
{
	include"menu.php";
}
?>
<?php include"slide.php";?>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<style>
body{background-color:}
.r{margin:20px;height:260px;}
.r:hover img{-webkit-filter: blur(5px) grayscale(100%);filter: blur(5px) grayscale(100%);}
.r1{position:absolute;left:15%;width:60%;height:100%;top:0%;
color:white;visibility:hidden;}
.r:hover .r1{color:black;visibility:visible;}
.r2{position:absolute;left:10%;width:80%;height:80%;top:0%;}
.body{margin-top:515px;margin-left:65px;}
</style>

<body onload="slider()">
<div class="fluid-container body">
<?php 

		include"connection.php";
		
		$q="select * from product" ;
		$sq=mysqli_query($connection,$q);
if($sq)
{
		if(mysqli_fetch_assoc($sq)>0)
		{
		
	$sq=mysqli_query($connection,$q);
		echo'<div class="row">';
			while($r=mysqli_fetch_assoc($sq))
			{
			echo'<div class="col-md-3">';
			echo'<div class="r">';
			
			echo'<div class="r2">';
echo '<br><img src="'.$r['pphoto'].'" width="100%" height="100%">';
				echo'</div>';
				echo'<div class="r1">';
				$pid=$r['pid'];
				echo '<br><b>'.$r['pname'];
				echo ' by '.$r['partist'];
				echo '<br>Category:'.$r['pcategory'];
				echo '<br>Uploaded By '.$r['uploadedBy'];
				echo '<br>Base Price: '.$r['pbase'];
				echo '<br>Total Bids: '.$r['totalBids'];
				echo '<br>Recent Bid Amount: '.$r['recentBid'];
				echo '</b><br><a href="ubid.php?pid='.$r['pid'].'"> Place your Bid </a>';
				echo'</div>';
				
			echo'</div>';
			echo'</div>';
				}
			echo'</div>';
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
</body>
