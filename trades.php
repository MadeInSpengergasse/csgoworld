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

<title>CSGOWORLD.ME | Trades</title>
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
<div class="csgofont">Trades</div><br><br>


<?php

//CONNECTING
$db = mysqli_connect("localhost", "csgoworld", "", "csgoworld");
if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}

$first_10_trades = mysqli_query($db, "SELECT * FROM `trades` ORDER BY `last_bump` DESC LIMIT 10");


//THE FIRST 10 TRADES
//for( $i=1; $i<11; $i++ )
for($i=0; $i<10; $i++)
{
	//getting current row of the first 10 trades
	$tradeI = mysqli_fetch_object($first_10_trades);
	
	//GETTING USER ID
	$user_id = $tradeI->user_id;
	
	//GETTING TRADE #i
	//$tradeI = mysqli_query($db, "SELECT * FROM `trades_have` WHERE `trade_id`=".$i);
	
	//STARTING THE TRADE WINDOW	
	echo "<div class='trade'>";
	
	//GETTING THE USERNAME TO THE USER ID
	$username_query = mysqli_query($db, "SELECT * FROM `users` WHERE `steam_id`=".$user_id);
	$row_username = mysqli_fetch_object($username_query);
	$username = $row_username->user_name;
	$trade_url = $row_username->steam_trade_url;
	
	$trade_id = $tradeI->trade_id;
	
	
	echo "<div class='tradeheader'>";
	
	echo "<a class='tradeowner'>Trade owner: <a class=\"tradeowner\" href=\"".$trade_url."\">".$username."</a></a>";

	//ENDING THE TRADE HEADER
	echo "</div>";
	
	echo "<div class='tradebody'>";
	
	$have = mysqli_query($db, "SELECT * FROM `trades_have` WHERE `trade_id`='".$trade_id."'");
	$want = mysqli_query($db, "SELECT * FROM `trades_want` WHERE `trade_id`='".$trade_id."'");
	
	echo "<div class='left'>";
	
	while($row_have = mysqli_fetch_object($have)){
		$item_id = $row_have->item_id;
		
		
		//GETTING THE ITEM NAME TO THE ITEM ID
		$item_to_id = mysqli_query($db, "SELECT * FROM `items` WHERE `item_id` = ".$item_id);
		$row_item_to_id = mysqli_fetch_object($item_to_id);
		$item_name = $row_item_to_id->item_name;
		$icon_url = $row_item_to_id->icon_url;
		$item_rarity = $row_item_to_id->item_rarity;
		$item_exterior = $row_item_to_id->item_exterior;
		
		if($item_exterior == ""){
			echo "<img onmouseover=\"nhpup.popup('".$item_name."<br><br>".$item_rarity."');\" src='http://steamcommunity-a.akamaihd.net/economy/image/".$icon_url."/99fx66f' alt='Picture not found!' class='img'>";	
		} else {
		echo "<img onmouseover=\"nhpup.popup('".$item_name." (".$item_exterior.")<br><br>".$item_rarity."');\" src='http://steamcommunity-a.akamaihd.net/economy/image/".$icon_url."/99fx66f' alt='Picture not found!' class='img'>";	
		}
	}
	
	echo "</div>";
	echo "<div class='right'>";

	while($row_want = mysqli_fetch_object($want)){
		$item_id = $row_want->item_id;
		
		//GETTING THE ITEM NAME TO THE ITEM ID
		$item_to_id = mysqli_query($db, "SELECT * FROM `items` WHERE `item_id` = ".$item_id);
		$row_item_to_id = mysqli_fetch_object($item_to_id);
		$item_name = $row_item_to_id->item_name;
		$icon_url = $row_item_to_id->icon_url;
		$item_rarity = $row_item_to_id->item_rarity;
		$item_exterior = $row_item_to_id->item_exterior;
		
		if($item_exterior == ""){
		echo "<img onmouseover=\"nhpup.popup('".$item_name." (".$item_exterior.")<br><br>".$item_rarity."');\" src='http://steamcommunity-a.akamaihd.net/economy/image/".$icon_url."/99fx66f' alt='Picture not found!' class='img'>";	
		} else {
			echo "<img onmouseover=\"nhpup.popup('".$item_name." (".$item_exterior.")<br><br>".$item_rarity."');\" src='http://steamcommunity-a.akamaihd.net/economy/image/".$icon_url."/99fx66f' alt='Picture not found!' class='img'>";	
		}
	}

	echo "</div>";

	/*
	//FOR EVERY ITEM IN TRADES_HAVE WITH THE TRADE ID i
	while($row_tradeI = mysqli_fetch_object($tradeI))
	{
		//GETTING THE ITEM NAME TO THE ITEM ID
		$item_to_id = mysqli_query($db, "SELECT * FROM `items` WHERE `item_id` = ".$row_tradeI->item_id);

		$row_item_to_id = mysqli_fetch_object($item_to_id);
		
		echo "<img onmouseover=\"nhpup.popup('".$row_item_to_id->item_name."');\" src='".$row_item_to_id->item_pic."' alt='Picture not found!' class='img'>";		
	}
	*/
	
	//ENDING THE TRADE BODY
	echo "</div>";
		
	//ENDING THE TRADE WINDOW
	echo "</div>";
}


?>


</div>
</body>
<footer>
Powered by <a href="http://steampowered.com">Steam</a>.
SteamAuth by <a href="https://github.com/SmItH197/SteamAuthentication">SmItH197</a>
Hover-Over-Popups by <a href="http://www.nicolashoening.de/?twocents&nr=8">nicolashoening</a>
</footer>
</html>
