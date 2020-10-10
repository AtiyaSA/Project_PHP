<?php
session_start();
if(isset($_SESSION['aid']))
{
	header("location:home.php");
}
?>
<style>
a{text-decoration:none;}
</style>
<h1>Hey, you have successfully registered.</h1>

<h3>Click here to <a href="login.php">log in</a></h3>