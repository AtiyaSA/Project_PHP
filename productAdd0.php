<?php
session_start();
if($_SESSION['uid']!=session_id())
{
	header("location:login.php");
}
?>
<?php include"umenu.php";?>
<!--Adding products in product and sell table, validation and create bid table-->
<?php
$np=$nps=$na=$nas=$b=$bs=$c=$cs=$ms='';
//Validation
function checkname1()
{
	$n=trim($_POST['np']);
	$nc='/^[a-zA-Z ]*$/';
	if (preg_match($nc,$n) && $n!='')
	{
		return 'y';
	}
	else
	{
		return 'n';
	}
}
function checkname2()
{
	$n=trim($_POST['na']);
	$nc='/^[a-zA-Z ]*$/';
	if (preg_match($nc,$n) && $n!='')
	{
		return 'y';
	}
	else
	{
		return 'n';
	}
}
function checkname3()
{
	$n=trim($_POST['c']);
	$nc='/^[a-zA-Z, ]*$/';
	if (preg_match($nc,$n) && $n!='')
	{
		return 'y';
	}
	else
	{
		return 'n';
	}
}
//checks base cost
function checkphone()
{
	$p=trim($_POST['b']);
	$pc='/^[0-9]{2,10}$/';
	if(preg_match($pc,$p))
	{
		return 'y';
	}
	else
	{
		return 'n';
	}
}

function checkphoto()
{
	if($_FILES['m']['name']!='')
	{
		$fn=$_FILES['m']['name'];
		$exp=strrpos($fn,'.');
		$ext=substr($fn,$exp+1,strlen($fn));
$aa=array('bmp','jpg','png','jpeg','gif');
			if(in_array($ext,$aa))
			{
			return 'y';
			}
			else
			{
			return 'n';
			}
	}
	else
	{
	return 'n';
	}
}

if(isset($_POST['a']))
{
	$un=$_SESSION['name'];
	$uid=$_SESSION['id'];
	$np=trim($_POST['np']);
	if(checkname1()=='n')
	{
		$nps='** check product name';
	}
	$na=trim($_POST['na']);
	if(checkname1()=='n')
	{
		$nas='** check artist name';
	}
	$c=trim($_POST['c']);
	if(checkname1()=='n')
	{
		$cs='** check category name';
	}
	
	$b=trim($_POST['b']);
	if(checkphone()=='n')
	{
		$bs='** check base cost';
	}
	if(checkphoto()=='n')
	{
		$ms='** check photo';
	}
	
	if(checkname1()=='y' && checkname2()=='y' && checkname3()=='y'&& checkphone()=='y'&& checkphoto()=='y')
	{
	
	$fn=$_FILES['m']['name'];
	
	$ta=$_FILES['m']['tmp_name'];
	
	$fa='photo/'.uniqid().$fn;
	
		include"connection.php";
		
		$q0="insert into product(pname,partist,pbase,pcategory,uploadedBy,uploaderID,pphoto)
		values('".$np."','".$na."','".$b."','".$c."','".$un."','".$uid."','".$fa."')";
		
		$sq0=mysqli_query($connection,$q0);
		
		if($sq0)
		{
			move_uploaded_file($ta,$fa);
		}
		else
		{
			echo mysqli_error($connection);
		}
		
		
		//Calling from product table
		
		$q1="select * from product where pphoto='".$fa."'";
		$sq1=mysqli_query($connection,$q1);
		if($sq1)
		{
			if(mysqli_fetch_array($sq1)>0)
			{
				
				$sq1=mysqli_query($connection,$q1);
				while($r=mysqli_fetch_array($sq1))
				{
					$pid=$r['pid'];
				}
			}
		}
		else{ echo mysqli_error($connection);}
		
		//insert into sell table
		
		$q2="insert into sell".$uid."(productid,sname,sartist,sbaseCost,scategory,sphoto)values('".$pid."','".$np."','".$na."','".$b."','".$c."','".$fa."')";
		
		$sq2=mysqli_query($connection,$q2);
		
		if($sq2)
		{
			move_uploaded_file($ta,$fa);
		}
		else
		{
			echo mysqli_error($connection);
		}
		$q3="create table bid".$pid."(bid int(5)auto_increment, userID int(5) not null, userName varchar(90) not null, userEmail varchar(50) not null, bidAmount int(10) not null,primary key(bid))";
		$sq3=mysqli_query($connection,$q3);
		if($sq3)
		{
			echo"<script>alert('Your Painting has beed registered!')</script>";
			
		$np=$nps=$na=$nas=$b=$bs=$c=$cs=$ms='';
		}
		else
		{
			echo mysqli_error($connection);
		}
			
	}
	else
	{
		echo'<script> alert(" check ")</script>';
	}
}
?>
<!--Buttons Add and Show-->
<form action="" method="POST" enctype="multipart/form-data">
Name of the painting: <input type="text" name="np" value="<?php echo $np;?>">
<span name="nps"><?php echo $nps;?></span><br><br>
Name of the Artist: <input type="text" name="na" value="<?php echo $na;?>">
<span name="nas"><?php echo $nas;?></span><br><br>
Category of Painting: <input type="text" name="c" value="<?php echo $c;?>">
<span name="cs"><?php echo $cs;?></span><br><br>
Base Cost (in INR): <input type="text" name="b" value="<?php echo $b;?>">
<span name="bs"><?php echo $bs;?></span><br><br>
Image of Painting: <input type="file" name="m">
<span ><?php echo $ms; ?></span><br><br><br><br>
<input type="submit" name="a" value="ADD">
</form>






