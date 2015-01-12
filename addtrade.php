<?php
    require ('steamauth/steamauth.php');  
    
	# You would uncomment the line beneath to make it refresh the data every time the page is loaded
	// $_SESSION['steam_uptodate'] = false;
?>
<!doctype html>
<html>
<head>
<link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.ico">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/trades.css">
<link rel="stylesheet" href="css/addtrade.css">
<!-- <link rel="stylesheet" href="css/style.css"> -->
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold" type="text/css" />
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/nhpup_1.1.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/addtrade.js"></script>

<meta charset="utf-8">
<title>CSGOWORLD.ME | Add a trade</title>
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
<div id="title">
<b>ADD A TRADE</b>
</div>
<br><br>

<?php


if(!isset($_SESSION['steamid'])) {
	exit("Please log in first!");	
}

//CONNECTING
$db = mysqli_connect("localhost", "csgoworld", "", "csgoworld");
if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}
 


?>

<div id="addtrade">


<div id="addtrade_have">
</div>

<div id="addtrade_want">
</div>
<textarea name="comment" id="comment" placeholder="Enter your comment here!" maxlength="400" rows="5" cols=""></textarea>
<button onClick="submit();" id="button">Add trade!</button>
</div>
<div id="invs">
<div id="inventory">

<h1 class="title center">Inventory</h1>

<?php


//INVENTORY SEARCHING
$inv = file_get_contents("http://steamcommunity.com/profiles/".$steamprofile['steamid']."/inventory/json/730/2?l=english");

$decoded_inv = json_decode($inv, true);

$success = $decoded_inv['success'];



foreach ($decoded_inv['rgDescriptions'] as &$item) {
	$marketable = $item['marketable'];
	//-----------------------------------
	//TRAD(E)ABLE MAYBE BROKEN IN THE FUTURE
	//-----------------------------------
	$tradeable = $item['tradable'];

	if($marketable == "1" and $tradeable == "1"){
			

		$item_id = $item['classid']; // unique identification
		$icon_url = $item['icon_url']; //eg some random text
		$item_name = $item['name']; //eg ssg08 dark water
		$rarity = "";
		$exterior = "";
		
		//GETTING IN A RANDOM POS EVERY NEEDED INFO
		foreach ($item['tags'] as &$tags){
			$category = $tags['category'];
		
			if($category == "Rarity"){
				$rarity = $tags['name'];
			}
			if($category == "Exterior"){
				$exterior = $tags['name'];
			}
		
			
		}
		if($exterior == ""){
			echo "<img onmouseover=\"nhpup.popup('".$item_name."<br><br>".$rarity."');\" src='http://steamcommunity-a.akamaihd.net/economy/image/".$icon_url."/99fx66f' alt='Picture not found!' class='img' data-id='".$item_id."' onClick=\"addTrade('true', this);\">";	
		} else {
			echo "<img onmouseover=\"nhpup.popup('".$item_name." (".$exterior.")<br><br>".$rarity."');\" src='http://steamcommunity-a.akamaihd.net/economy/image/".$icon_url."/99fx66f' alt='Picture not found!' class='img' data-id='".$item_id."' onClick=\"addTrade('true', this);\">";	
		}
			
			
		

		
			
		
	}
	
	
}



?>


</div>

<div id="item_list">

		<!-- <div class="icon"></div> -->
		<h1 class="title center">Item search</h1>

		<!-- Main Input -->
		<input type="text" id="search" autocomplete="off">

		<!-- Show Results -->
		<h4 id="results-text">Showing results for: <b id="search-string">Array</b></h4>
        <div id="results"></div>
		<!-- <ul id="results"></ul> -->


</div>
</div>
</div>
</body>
<footer>
Powered by <a href="http://steampowered.com">Steam</a>.
SteamAuth by <a href="https://github.com/SmItH197/SteamAuthentication">SmItH197</a>
Hover-Over-Popups by <a href="http://www.nicolashoening.de/?twocents&nr=8">nicolashoening</a>
</footer>
</html>
