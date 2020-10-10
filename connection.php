<?php
$s1='localhost:3306';
$u1='root';
$p1='argus';
$d1='project';
$connection=mysqli_connect($s1,$u1,$p1,$d1);

	if(!$connection)
	{
		echo mysqli_connect_error();
	}

?>