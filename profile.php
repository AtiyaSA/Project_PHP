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
$na=$nas=$e=$ec=$p=$pc=$f=$fn=$ta=$fa=$es=$pss=$ps=$cpss=$cps=$ph=$d=$ds=$ms='';
?>
<style>
#photo{position:absolute;top:10%;right:10%;width:20%;height:40%;border-radius:50px;overflow:hidden;z-index:-1;}
#pf{position:absolute; top:10%; left:10%; width:35%; font-family:Century Gothic; font-size:2em;background-color:white;height:42%;border-radius:50px; line-height:50px;text-align:center;}
#edit{position:absolute; border-radius:50px; border-color:rgba(250,133,151,1); cursor:pointer;color:blue;left:45%; }
.c{border-radius:10px; height:30px;border-color:rgb(144,113,99);width:70%, }
.body{position:absolute; top:10%; background:rgba(250,133,151,0.5); height:90%;width:30%;border-radius:50px;left:35%;box-shadow: 7px 8px 5px rgba(242,136,183,0.8);}
.form{position:absolute;top:0%; left:10%;font-size:2em; z-index:1; top:10%; left:10%; width:55%; heigth:60%; visibility:hidden;}

.s{background:white;border-color:rgba(250,133,151,1);color:rgba(241,128,145,1);height:30px;width:100%;font-family:Century Gothic;font-size:0.5em;}
#cancel{background:white;border-color:rgba(250,133,151,1);color:rgba(241,128,145,1);height:30px;width:100%;font-family:Century Gothic;font-size:0.5em; overflow:hidden;}

</style>

<body>
<div id="photo" class="photo"><img src="<?php echo $_SESSION['photo'];?>" height="100%" width="100%"></div>
<div id="pf"><?php echo $_SESSION['name'].'<br>'.$_SESSION['email'].'<br>'.$_SESSION['phone'].'<br>'.$_SESSION['dob'];?>
<div id="edit" onclick="edit()">Edit</div></div>
<div id="form" class="form">
	<form  action="updatep.php" method="POST" enctype="multipart/form-data">

		<input class="c" type="text" name="na" placeholder="Enter your Name" value="<?php echo $_SESSION['name'];?>">
		<span><?php echo $nas; ?></span><br><br>
		<input class="c" type="text" name="e"  readonly value="<?php echo $_SESSION['email'];?>"><br><br>
		
		<input class="c" type="text" name="p"  placeholder="Enter your 10 digit phone number" value="<?php echo $_SESSION['phone'];?>"  maxlength="10"><span ><?php echo $ph; ?></span><br><br>
		
		<input class="c" type="password" name="ps"  placeholder="Enter Password[8-12 characters]" maxlength="10" value="<?php echo $ps;?>"><span ><?php echo $pss; ?></span><br><br>
		
		<input class="c"  placeholder="Confirm password" type="password" name="cps" maxlength="10" value="<?php echo $cps;?>"><span ><?php echo $cpss; ?></span><br><br>
		
		DOB:[above 18 years]<input type="date" class="c" name="d" value="<?php echo $_SESSION['dob'];?>"><span ><?php echo $ds; ?></span><br><br>
		
		Update image <input type="file" id="ph" name="m">
		<span ><?php echo $ms; ?></span><br><br>
		<input type="submit" name="s" class="s">
		
	</form>
	<div><button id="cancel" onclick="cancel()">Cancel</button>
</div>

<script>

function edit()
{
	document.getElementById("pf").style.visibility="hidden";
	document.getElementById("form").style.visibility="visible";
}

function cancel()
{
	document.getElementById("pf").style.visibility="visible";
	document.getElementById("form").style.visibility="hidden";
}

</script>

</body>





