<?php
session_start();
if($_SESSION['uid']!=session_id())
{
	header("location:login.php");
}
?>
<?php
include"umenu.php";
?>

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
//checks base cost
function checkphone()
{
	$p=trim($_POST['b']);
	$pc='/^[0-9]*$/';
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
	return 'no';
	}
}

if(isset($_POST['s']))
{
$pid=$_GET['pid'];

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
	
if(checkname1()=='y' && checkname2()=='y' && checkname3()=='y'&& checkphone()=='y'&& checkphoto()=='y' )
	{

		$fn=$_FILES['m']['name'];
		
		$ta=$_FILES['m']['tmp_name'];
		
		$fa='photo/'.uniqid().$fn;

		include"connection.php";
		$q="update sell".$id." set sname='".$np."' ,sartist='".$na."',scategory='".$c."',sbaseCost='".$b."',sphoto='".$fa."' where productid='".$pid."'";
		
		$sq=mysqli_query($connection,$q);
		if($sq)
		{
			move_uploaded_file($ta,$fa);
		}
		else
		{
			echo mysqli_error($connection);
		}
		$q1="update product set pname='".$np."' ,partist='".$na."',pcategory='".$c."',pbase='".$b."',pphoto='".$fa."' where pid='".$pid."'";
		
		$sq1=mysqli_query($connection,$q1);
		if($sq1)
		{
			echo'<script> alert(" updated ")</script>';
			move_uploaded_file($ta,$fa);
		$e=$ec=$p=$pc=$f=$fn=$ta=$fa=$es=$pss=$ps=$ph=$d=$ds=$ms='';
	
		}
		else
		{
			echo mysqli_error($connection);
		}
	}
	else
{
	
	if(checkname1()=='y' && checkname2()=='y' && checkname3()=='y'&& checkphone()=='y'&& checkphoto()=='no')
{
	include"connection.php";
		$q="update sell".$id." set sname='".$np."' ,sartist='".$na."',scategory='".$c."',sbaseCost='".$b."' where productid='".$pid."'";
		
		$sq=mysqli_query($connection,$q);
		if(!$sq)
		{
			echo mysqli_error($connection);
		}
		
		
		$q1="update product set pname='".$np."' ,partist='".$na."',pcategory='".$c."',pbase='".$b."' where pid='".$pid."'";
		
		$sq1=mysqli_query($connection,$q1);
		if($sq1)
		{
			echo'<script> alert(" updated ")</script>';
		
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
}
?>
<!-- 1st below code then above code of isset!-->
<?php 

	if(isset($_GET['pid']))
	{
	$pid=$_GET['pid'];
	
					include"connection.php";
					
					$q="select * from sell".$id." where productid=".$pid;
					$sq=mysqli_query($connection,$q);
					
					if($sq)
					{
						while($r=mysqli_fetch_array($sq))
						{
						
echo'<form action="" method="POST" enctype="multipart/form-data">
Name of the painting: <input type="text" name="np" value="'.$r["sname"].'">
<span name="nps"><?php echo $nps;?></span><br><br>
Name of the Artist: <input type="text" name="na" value="'.$r["sartist"].'">
<span name="nas"><?php echo $nas;?></span><br><br>
Category of Painting: <input type="text" name="c" value="'.$r["scategory"].'">
<span name="cs"><?php echo $cs;?></span><br><br>
Base Cost (in INR): <input type="text" name="b" value="'.$r["sbaseCost"].'">
<span name="bs"><?php echo $bs;?></span><br><br>
<img src="'.$r["sphoto"].'" width="50" height="50">
<br>
load image <input type="file" name="m" >
<span ><?php echo $ms; ?></span><br><br>

<input type="submit" name="s" value="update">
</form>';
						
						
						
						}
					
					
					}
					else
					{
						echo mysqli_error($connection);
					}
	
	}
	else
	{
	header("location:profile.php");
	}
?>