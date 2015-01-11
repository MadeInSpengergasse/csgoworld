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
<title>CSGOWORLD.ME | My Profile</title>
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

	
	
<div id="body">

</div>
<br><br>
<div id="content">
<div class="csgofont">My Profile</div><br><br>
<?php
if(!isset($_SESSION['steamid'])) {
	exit("Please log in first!");	
}

$db = mysqli_connect("localhost", "csgoworld", "", "csgoworld");
if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}



if(isset($_POST['trade_url_post'])){
	if(strpos($_POST['trade_url_post'],'https://steamcommunity.com/tradeoffer/new/?partner=') !== false){
			mysqli_query($db, "UPDATE `users` SET `steam_trade_url`='".$_POST['trade_url_post']."' WHERE `steam_id`='".$steamprofile['steamid']."'");
			echo "Trade url set!<br>";
	} else {
			echo "Please submit a valid trade url!<br>";
	}
}



echo "Hey, ".$steamprofile['personaname']."! Here is your Steam-ID: ".$steamprofile['steamid']."!";

?>

<form action='profile.php' method='post'>

<?php
$trade_url = mysqli_query($db, "SELECT steam_trade_url FROM `users` WHERE `steam_id`='".$steamprofile['steamid']."'");

echo "Where can you get your steam trade url? <a href='http://steamcommunity.com/id/me/tradeoffers/privacy'>Here</a>!<br>";
if(is_null($trade_url)){
	echo "Your steam trade url: <input type='text' class='trade_url' size='70' name='trade_url_post' />";
} else {
	$row_trade_url = mysqli_fetch_object($trade_url);
	echo "Your steam trade url: <input type='text' class='trade_url' size='70' name='trade_url_post' value='".$row_trade_url->steam_trade_url."'/>";
}
?>

<p><input type='submit' value='Submit'/></p>
</form>





</div>
</body>
<footer>
Powered by <a href="http://steampowered.com">Steam</a>.
SteamAuth by <a href="https://github.com/SmItH197/SteamAuthentication">SmItH197</a>
Hover-Over-Popups by <a href="http://www.nicolashoening.de/?twocents&nr=8">nicolashoening</a>
</footer>
</html>
