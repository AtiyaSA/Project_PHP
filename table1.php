<?php
include"connection.php";

$q="create table user (id int(5) auto_increment ,
						name varchar(90) not null,
						email varchar(50) unique ,
						phone varchar(15) not null,
						password varchar(15) not null,
						dob date not null,
						photo varchar(100) not null,
						primary key(id))";
						
			$sq=mysqli_query($connection,$q);
			if($sq)
			{
				echo ' table created';
			}
			else
			{
				echo mysqli_error($connection);
			}

$q0="create table product (pid int(5) auto_increment ,
						pname varchar(90) not null,
						partist varchar(50) not null ,
						pbase int(15) not null,
						pcategory varchar(300) not null,
						uploadedBy varchar(90) not null,
						uploaderID int(5) not null,
						totalBids int(5),
						recentBid int(5),
						pphoto varchar(100) not null,
						primary key(pid))";
						
			$sq0=mysqli_query($connection,$q0);
			if($sq0)
			{
				echo ' table created';
			}
			else
			{
				echo mysqli_error($connection);
			}

?>