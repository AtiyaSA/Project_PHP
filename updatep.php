<?php
session_start();
if($_SESSION['uid']!=session_id())
{
	header("location:login.php");
}
?>
<?php
function checkname1()
{
	$na=trim($_POST['na']);
	$nc='/^[a-zA-Z ]*$/';
	if (preg_match($nc,$na) && $na!='')
	{
		return 'y';
	}
	else
	{
		return 'n';
	}
}

function checkemail()
{
	$e=trim($_POST['e']);
	$ec='/^[a-zA-Z0-9._-]*\@[a-zA-Z.]*\.[a-zA-Z]{2,6}$/';
	if(preg_match($ec,$e))
	{
		return 'y';
	}
	else
	{
		return 'n';
	}
}

function checkphone()
{
	$p=trim($_POST['p']);
	$pc='/^[0-9]{10,10}$/';
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

function checkpassword()
{
	$ps=trim($_POST['ps']);
	if(strlen($ps)>=4 && strlen($ps)<=10)
	{
		return 'y';
	}
	else if($ps=='')
	{
		return 'no';
	}
	else
	{
		return 'n';
	}
}
function confirmPassword()
{
	$ps=trim($_POST['ps']);
	$cps=trim($_POST['cps']);
	if($cps==$ps)
	{
		return 'y';
	}
	else
	{
		return 'n';
	}
}
function checkdate1()
{
	if($_POST['d']!='')
	{
	$sd=date('Y');
	$ed=date('Y',strtotime($_POST['d']));
		if(($sd-$ed)>=18)
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

if(isset($_POST['s']))
{
	$na=trim($_POST['na']);
	if(checkname1()=='n')
	{
		$nas='** check name';
	}
	
	$e=trim($_POST['e']);
	if(checkemail()=='n')
	{
		$es='** check email';
	}
	
	$p=trim($_POST['p']);
	if(checkphone()=='n')
	{
		$ph='** check phone';
	}
	$ps=trim($_POST['ps']);
	if(checkpassword()=='n')
	{
		$pss='** check password';
	}
	if(confirmPassword()=='n')
	{
		$cpss='** passwords do not match';
	}
	
	
	if(checkdate1()=='n')
	{
		$ds='** check date';
	}
	else
	{
	$d=date('Y-m-d',strtotime($_POST['d']));
	}
	
	if(checkphoto()=='n')
	{
		$ms='** check photo';
	}
	
	if(checkname1()=='y' && checkemail()=='y' && checkphone()=='y' && checkpassword()=='y' && checkdate1()=='y' && checkphoto()=='y' && confirmPassword()=='y')
	{
	
	$fn=$_FILES['m']['name'];
	
	$ta=$_FILES['m']['tmp_name'];
	
	$fa='photo/'.uniqid().$fn;
	
		include"connection.php";
		$q="update user set name='".$na."', password='".$ps."', phone=".$p." dob='".$d."',photo='".$fa."' where id=".$_SESSION['id'];
			
			$sq=mysqli_query($connection,$q);
			if($sq)
			{
				$_SESSION['rd']=session_start();
				$_SESSION['e']=$e;
				$_SESSION['name']=$na;
				$_SESSION['date']=$d;
				$_SESSION['phone']=$p;
				$_SESSION['password']=$ps;
				$_SESSION['photo']=$fa;
				echo'<script> alert(" registered ")</script>';
				move_uploaded_file($ta,$fa);
				$na=$nas=$e=$ec=$p=$pc=$f=$fn=$ta=$fa=$es=$pss=$ps=$ph=$d=$ds=$ms='';
				header("location:profile.php");
			
			}
			else
			{
				echo mysqli_error($connection);
			}
			
	}
	else if(checkname1()=='y' && checkemail()=='y' && checkphone()=='y' && checkpassword()=='y' && checkdate1()=='y' && checkphoto()=='no' && confirmPassword()=='y')
	{
		include"connection.php";
		$q="update user set name='".$na."', password='".$ps."',dob='".$d."', phone=".$p."  where id=".$_SESSION['id'];
			
			$sq=mysqli_query($connection,$q);
			if($sq)
			{
				$_SESSION['rd']=session_start();
				$_SESSION['e']=$e;
				$_SESSION['name']=$na;
				$_SESSION['date']=$d;
				$_SESSION['phone']=$p;
				$_SESSION['password']=$ps;
				echo'<script> alert(" registered ")</script>';
				move_uploaded_file($ta,$fa);
				$na=$nas=$e=$ec=$p=$pc=$f=$fn=$ta=$fa=$es=$pss=$ps=$ph=$d=$ds=$ms='';
				header("location:profile.php");
			
			}
			else
			{
				echo mysqli_error($connection);
			}
			
	}
	else if(checkname1()=='y' && checkemail()=='y' && checkphone()=='y' && checkpassword()=='no' && checkdate1()=='y' && checkphoto()=='y' && confirmPassword()=='y')
	{
		
		$fn=$_FILES['m']['name'];
		
		$ta=$_FILES['m']['tmp_name'];
		
		$fa='photo/'.uniqid().$fn;
		include"connection.php";
		$q="update user set name='".$na."', dob='".$d."', phone=".$p.",photo='".$fa."' where id=".$_SESSION['id'];
			
			$sq=mysqli_query($connection,$q);
			if($sq)
			{
				$_SESSION['rd']=session_start();
				$_SESSION['e']=$e;
				$_SESSION['name']=$na;
				$_SESSION['date']=$d;
				$_SESSION['phone']=$p;
				$_SESSION['photo']=$fa;
				echo'<script> alert(" registered ")</script>';
				move_uploaded_file($ta,$fa);
				$na=$nas=$e=$ec=$p=$pc=$f=$fn=$ta=$fa=$es=$pss=$ps=$ph=$d=$ds=$ms='';
				header("location:profile.php");
			
			}
			else
			{
				echo mysqli_error($connection);
			}
			
	}
	else if(checkname1()=='y' && checkemail()=='y' && checkphone()=='y' && checkpassword()=='no' && checkdate1()=='y' && checkphoto()=='no' && confirmPassword()=='y')
	{
		include"connection.php";
		$q="update user set name='".$na."',dob='".$d."' , phone=".$p." where id=".$_SESSION['id'];
			
			$sq=mysqli_query($connection,$q);
			if($sq)
			{
				$_SESSION['rd']=session_start();
				$_SESSION['e']=$e;
				$_SESSION['name']=$na;
				$_SESSION['date']=$d;
				$_SESSION['phone']=$p;
				echo'<script> alert(" registered ")</script>';
				move_uploaded_file($ta,$fa);
				$na=$nas=$e=$ec=$p=$pc=$f=$fn=$ta=$fa=$es=$pss=$ps=$ph=$d=$ds=$ms='';
				header("location:profile.php");
			
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