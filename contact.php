<?php
    require ('steamauth/steamauth.php');  
    
	# You would uncomment the line beneath to make it refresh the data every time the page is loaded
	// $_SESSION['steam_uptodate'] = false;
?>
<!doctype html>
<html>
<head>
<link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.ico">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/trades.css">
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/nhpup_1.1.js"></script>
<meta charset="utf-8">
<meta name="description" content="Join now CSGOWORLD! Trading in the best way! No signup - completely free!">
<title>CSGOWORLD.ME | Contact</title>
</head>

<body>
<div id="top">
<div id="links">
<a class="headline csgofont" href="index.php" id="main">CSGOWORLD</a>
<a class="headline csgofont" href="trades.php" id="trades">Trades</a>
<?php
if(isset($_SESSION['steamid'])) {

echo '<a class="headline csgofont" href="profile.php" id="profile">My Profile</a>';
echo '<a class="headline csgofont" href="addtrade.php" id="addtrade">Add a trade</a>';

}


if(!isset($_SESSION['steamid'])) {

    steamlogin(); //login button
    
}  else {
    include ('steamauth/userInfo.php');

    logoutbutton();
}    
?>  
</div>
</div>
<body>


<div id="head">
<img src="images/banner.png" align="middle" width="65%" height="100%" class="center banner">
</div>
	
<div id="body">
<div id="content">
<div class="csgofont title">Contact</div><br><br>

   Steam Links of the developers: <br>
   Technical stuff: <a href="http://steamcommunity.com/id/bigseeproduction/">BigSeeProduction</a>.<br>
   Design: <a href="http://steamcommunity.com/id/stollen3">Pulsa</a>.

<br><br><br><br><br><br><br><br><br><br><br>

</div>
</div>
</body>
<footer>
Powered by <a href="http://steampowered.com">Steam</a>.
SteamAuth by <a href="https://github.com/SmItH197/SteamAuthentication">SmItH197</a>
Hover-Over-Popups by <a href="http://www.nicolashoening.de/?twocents&nr=8">nicolashoening</a>
MySQL Search by <a href="http://ninetofive.me/blog/build-a-live-search-with-ajax-php-and-mysql">ninetofive.me</a>
Our <a href="http://www.spengergasse.at/">School</a>
<a href="/contact.php" style="float: right;">Contact</a>

</footer>
</html>
