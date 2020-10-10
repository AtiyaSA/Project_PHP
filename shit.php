<?php
include"connection.php";
$q0="create table bidHistory8(bID int(5) not null,
							pID int(5) not null,
							bname varchar(90) not null,
							bartist varchar(50) not null ,
							bbaseCost int(15) not null,
							bcategory varchar(300) not null,
							bphoto varchar(100) not null,
							bidPlaced int(10) not null,
							status varchar(20) default'UnderReview')";
							
				$sq0=mysqli_query($connection,$q0);
				if($sq0)
				{
					echo ' table created';
				}
				else
				{
					echo mysqli_error($connection);
				}