<?php
session_start();
if(isset($_SESSION['id']))
{
	header("location:profile.php");
}
?>

<?php include"menu.php";?>

<style>
.body{position:absolute; top:20%; background:rgba(250,133,151,0.5); height:40%;width:30%;border-radius:50px;left:35%;box-shadow: 7px 8px 5px rgba(242,136,183,0.8);}
#form{position:absolute;top:15%; left:20%;}
.i{height:35px;width:100%;border-radius:10px;}
#s{background:white;border-color:rgba(250,133,151,1);color:rgba(241,128,145,1);height:35px;width:100%;font-family:Century Gothic;font-size:1.4em;}
</style>
<body>
<div class="body">
<div id="form">
<form action="check.php" method="POST">
	<input type="text" class="i" name="e" placeholder="Enter Email"><br><br>
	<input type="password" class="i" name="p" placeholder="Enter Password"><br><br>
<input type="submit" name="s" id="s">
</form>
<br>Don't have an account? Register <a href="reg.php">here</a>
</div>
</div>
</body>