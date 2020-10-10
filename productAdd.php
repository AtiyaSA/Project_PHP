<?php
session_start();
if($_SESSION['uid']!=session_id())
{
	header("location:login.php");
}
?>
<!--Adding products in product and sell table, validation and create bid table-->
<?php
$np=$nps=$na=$nas=$b=$bs=$c=$cs=$ms='';
//Validation
function checkpname()
{
	$np=trim($_POST['np']);
	$npc='/^[a-zA-Z ]*$/';
	if(preg_match($npc,$np) && $np!='')
	{
		return 'y';		
	}
	else
	{
		return 'n';
	}
}
function checkcategory()
{
	$c=trim($_POST['c']);
	$cc='/^[a-zA-Z, ]*$/';
	if (preg_match($cc,$c) && $c!='')
	{
		return 'y';
	}
	else
	{
		return 'n';
	}
}
function checkaname()
{
	$na=trim($_POST['na']);
	$nac='/^[a-zA-Z ]*$/';
	if (preg_match($nac,$na) && $na!='')
	{
		return 'y';
	}
	else
	{
		return 'n';
	}
}
function checkBase()
{
	$b=trim($_POST['b']);
	$bc='/^[0-9]*$/';
	if(preg_match($bc,$b))
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
//Insert in product and sell tables
if(isset($_POST['a']))
{
	//calling session variables
	$un=$_SESSION['name'];
	$uid=$_SESSION['id'];
	$np=trim($_POST['np']);
	if(checkpname()=='n')
	{
		$nps='** check name';
	}
	$na=trim($_POST['na']);
	if(checkaname()=='n')
	{
		$nas='** check name';
	}
	$c=trim($_POST['c']);
	if(checkcategory()=='n')
	{
		$cs='** check category';
	}
	$b=trim($_POST['b']);
	if(checkBase()=='n')
	{
		$bs='** check phone';
	}
	if(checkphoto()=='n')
	{
		$ms='** check photo';
	}
	
	
	if (checkpname()=='y' && checkaname()=='y' && checkBase()=='y' &&
		checkphoto()=='y' && checkcategory()=='y')
	{
		$fn=$_FILES['m']['name'];
		$ta=$_FILES['m']['tmp_name'];
		$fa='photo/'.uniqid().$fn;
		//Insert in product table
		
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
			echo mysql_error($connection);
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
		
		//insert into sell table
		
		$q2="insert into sell".$uid."(pid,pname,partist,pbase,pcategory,pphoto)
		values('".$pid."','".$np."','".$na."','".$b."','".$c."','".$fa."')";
		
		$sq2=mysqli_query($connection,$q2);
		
		if($sq2)
		{
			move_uploaded_file($ta,$fa);
		}
		else
		{
			echo mysql_error($connection);
		}
		$q3="create table bid".$pid."(bid int(5)auto_increment, userID int(5) not null, userName varchar(90) not null, userEmail varchar(50) not null, bidAmount int(10) not null)";
		$sq3=mysqli_query($connection,$q3);
		if($sq3)
		{
			
		$np=$nps=$na=$nas=$b=$bs=$c=$cs=$ms='';
			header("location:productShow.php");
		}
		else
		{
			echo mysqli_error($connection);
		}
	}
}
?>
<!--Buttons Add and Show-->
<form action="" method="POST" enctype="multipart/form-data">
Name of the painting: <input type="text" name="np" value="<?php echo $np;?>">
<span name="nps" value="<?php echo $nps;?>"></span><br><br>
Name of the Artist: <input type="text" name="na" value="<?php echo $na;?>">
<span name="nas" value="<?php echo $nas;?>"></span><br><br>
Category of Painting: <input type="text" name="c" value="<?php echo $c;?>">
<span name="cs" value="<?php echo $cs;?>"></span><br><br>
Base Cost (in INR): <input type="text" name="b" value="<?php echo $b;?>">
<span name="bs" value="<?php echo $bs;?>"></span><br><br>
Image of Painting: <input type="file" name="m">
<span ><?php echo $ms; ?></span><br><br><br><br>
<input type="submit" name="a" value="ADD">
</form>