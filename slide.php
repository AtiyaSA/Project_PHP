<!--Slide show-->


<script>
var a=new Array('slide/1.jpg','slide/2.jpg','slide/3.jpg');
var i=0;
function slider()
{
	if(i<2)
	{
	i++;
	}
	else
	{
	i=0;
	}
	document.getElementById("imgg").src=a[i];
	setTimeout("slider()",3000);
	return i;
}
</script>

<style>
#x{position:absolute;top:0%;width:100%;height:80%;
left:0%;z-index:-1;}
#imgg{-webkit-filter: grayscale(100%);filter: grayscale(100%);}
#form{z-index:1;bottom:20%; position:absolute;left:15%; width:60%; height:10%}
#submit{z-index:1;bottom:20%; position:absolute;left:75%; width:5%; height:10%}

</style>
 
<div id="x">
		<img src="slide/1.jpg" width="100%" height="100%" id="imgg">
		<!--
		<form action="search.php" method="POST" >
			<input type="text" name="search" id="form" placeholder="Search by painting name, artist or category">
			<input type="submit"  id="submit" value="Search">
		</form>-->
</div>
