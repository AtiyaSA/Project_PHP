<?php
session_start();
if(isset($_SESSION['uid']))
{
	header("location:home.php");
}
else
{
	include"menu.php";
}
?>
<?php
$na=$nas=$e=$ec=$p=$pc=$f=$fn=$ta=$fa=$es=$pss=$ps=$cpss=$cps=$ph=$d=$ds=$ms='';

function checkname1()
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
	return 'n';
	}
}

function checkpassword()
{
	$ps=trim($_POST['ps']);
	if(strlen($ps)>=4 && strlen($ps)<=10)
	{
		return 'y';
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
	$n=trim($_POST['na']);
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
		$q="insert into user (name,email,phone,password,dob,photo)
			values ('".$n."','".$e."','".$p."','".$ps."','".$d."','".$fa."')";
			
			$sq=mysqli_query($connection,$q);
			if($sq)
			{
				$_SESSION['rd']=session_start();
				$_SESSION['e']=$e;
				echo'<script> alert(" registered ")</script>';
				move_uploaded_file($ta,$fa);
				$na=$nas=$e=$ec=$p=$pc=$f=$fn=$ta=$fa=$es=$pss=$ps=$ph=$d=$ds=$ms='';
				header("location:tables.php");
			
			}
			else
			{
				echo 'This email has already been registered. Try logging in <a href="login.php">here</a>';
			}
			
	}
	else
	{
		echo'<script> alert(" check ")</script>';
	}
}
?>
<style>
.c{border-radius:10px; height:30px;border-color:rgb(144,113,99);width:70%}
.body{position:absolute; top:10%; background:rgba(250,133,151,0.5); height:90%;width:30%;border-radius:50px;left:35%;box-shadow: 7px 8px 5px rgba(242,136,183,0.8);}
.form{position:absolute;top:4%; left:10%;}

.s{background:white;border-color:rgba(250,133,151,1);color:rgba(241,128,145,1);height:30px;width:100%;font-family:Century Gothic;font-size:1.4em;}
</style>

<body>
<div class="body">
<div class="form">
<form  action="" method="POST" enctype="multipart/form-data">

<input class="c" type="text" name="na" placeholder="Enter your Name" value="<?php echo $na;?>">
<span><?php echo $nas; ?></span><br><br>
<input class="c" type="text" name="e"  placeholder="Enter your Email" value="<?php echo $e;?>">
<span ><?php echo $es; ?></span><br><br>

<input class="c" type="text" name="p"  placeholder="Enter your 10 digit phone number" value="<?php echo $p;?>"  maxlength="10"><span ><?php echo $ph; ?></span><br><br>

<input class="c" type="password" name="ps"  placeholder="Enter Password[8-12 characters]" maxlength="10" value="<?php echo $ps;?>"><span ><?php echo $pss; ?></span><br><br>

<input class="c"  placeholder="Confirm password" type="password" name="cps" maxlength="10" value="<?php echo $cps;?>"><span ><?php echo $cpss; ?></span><br><br>

dob:[above 18 years]<input type="date" class="c" name="d" value="<?php echo $d;?>"><span ><?php echo $ds; ?></span><br><br>

load image <input type="file" id="ph" name="m">
<span ><?php echo $ms; ?></span><br><br>
<input type="submit" name="s"      class="s"><br><br>
<input type="submit" value="clear" class="s" name="s1">

</form>
<font>Already have an account? Login <a href="login.php">here</a>.</font>
</div>
</div>
</body>