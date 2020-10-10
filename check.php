<?php
	if(isset($_POST['s']))
	{
		$e=$_POST['e'];
		$p=$_POST['p'];
			if($e=='admin' && $p=='admin')
			{
				session_start();
				$_SESSION['aid']=session_id();
				$_SESSION['a']=$e;
				header("location:admin.php");
			}
			else
			{
			
				include"connection.php";
				$q="select * from user where email='".$e."' and password='".$p."'";
				$sq=mysqli_query($connection,$q);
				if($sq)
				{
					if(mysqli_fetch_array($sq)>0)
					{
							
							session_start();
							$_SESSION['uid']=session_id();
							if ($sq)
							{
								$sq=mysqli_query($connection,$q);
								while($r=mysqli_fetch_array($sq))
								{
									foreach($r as $key=>$value)
									if(is_string($key))
										$_SESSION[$key]=$value;
								}
							}
							header("location:home.php");
					}
					else
					{
						echo mysqli_error($connection);
						header("location:login.php");
					}
				}
				else
				{
					$script='<script>alert("Check the entered Email ID and password.");</script>';
					echo $script;
					
					
				}
			
			}
	}
	else
	{
			header("location:login.php");
	}

?>