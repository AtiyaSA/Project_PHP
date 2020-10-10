<style>
a{text-decoration:none; color:black;}
#menu {background:rgba(0,0,0,0.2); width:100%; height:7%;position:fixed;top:0%; left:0%;z-index:3;}
.mm{position:absolute; color:white; font-size:1.5vw; height:100%; line-height:40px; top:0%; text-align:center; font-family:Century Gothic; cursor:pointer;}
#hh{left:7%; width:10%}
#my{left:60%; width:20%}
#ll{left:85%; width:10%}
.mm:hover{background-color:black;}
.mmy{position:absolute; left:0%; visibility:hidden;height:100%; background:rgba(0,0,0,0.2); width:100%;text-align:center;}
#pp {top:100%;}
#ss {top:200%;}
#ps {top:300%;}
#bb {top:400%;}
#my:hover .mmy{visibility:visible;}
.mmy:hover{background-color:black;}

.img{position:absolute; height:100%; width:14%; background-size:cover;}
#pr{background-image:url("icons/profile.png");}
#sp{background-image:url("icons/sell.png");}
#mp{background-image:url("icons/paint.png");}
#mb{background-image:url("icons/bid.png");}

#pp:hover #pr{background-image:url("icons/profile1.png");}
#ss:hover #sp{background-image:url("icons/sell1.png");}
#ps:hover #mp{background-image:url("icons/paint1.png");}
#bb:hover #mb{background-image:url("icons/bid1.png");}

body{background:url(bg/unbg.jpg);background-size:auto; background-repeat:no repeat;}
</style>

<?php
	$a=$_SESSION['name'];
	$id=$_SESSION['id'];

?>
<div  id="menu" class="header">
	<div id="hh" class="mm"  onclick="location.href='home.php'">Home</div>
	<div id="my" class="mm"><?php echo $a; ?> 
		<div id="pp" class="mmy" onclick="location.href='profile.php'"><div id="pr" class="img"></div>My Profile</div>
		<div id="ss" class="mmy" onclick="location.href='productAdd0.php'"><div id="sp" class="img"></div>Sell a painting</div>
		<div id="ps" class="mmy" onclick="location.href='productShow.php'"><div id="mp" class="img"></div>My Paintings</div>
		<div id="bb" class="mmy" onclick="location.href='bidHistory.php'"><div  id="mb" class="img"></div>My Bids</div>
	</div>
	<div id="ll" class="mm"onclick="location.href='logout.php'">Logout</a></div>
</div>