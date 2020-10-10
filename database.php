<?php
$server="localhost:3306";
$user="root";
$password="argus";

$c=mysqli_connect($server,$user,$password);
	if($c)
	{
		$q="create database project";
		$sq=mysqli_query($c,$q);
		if($q)
		{
		echo' created ';
		}
		else
		{
		echo mysqli_error($c);
		}
	}
	else
	{
		echo'<br>'.mysqli_connect_error($c);
	}
?>