<?php

require ('steamauth/steamauth.php');  

if(!isset($_SESSION['steamid'])) {
    exit("You are not logged in!");
	steamLogin();
}  else {
    include ('steamauth/userInfo.php');
}    


//CONNECTING
$db = mysqli_connect("localhost", "csgoworld", "", "csgoworld");
if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}

$user_already_exists = mysqli_query($db, "SELECT 1 FROM `users` WHERE `steam_id='".$steamprofile['steamid']."'");
if(mysql_num_rows($user_already_exists) == 0){
		mysqli_query($db, "INSERT INTO `users` (steam_id, user_name) VALUES ('".$steamprofile['steamid']."', '".$steamprofile['personaname']."')");
}


$result = mysqli_query($db, "SELECT `user_name` FROM `users` WHERE `steam_id`=".$steamprofile['steamid']);

//IF STEAM ID IS NOT IN DATABASE
if($result->num_rows === 0)
    {
		mysqli_query($db, "INSERT INTO `users` (steam_id, user_name) VALUES ('".$steamprofile['steamid']."', '".$steamprofile['personaname']."')");
        echo 'No results';
    } else {
		echo "Results!";
		mysqli_query($db, "UPDATE `users` SET `user_name`='".$steamprofile['personaname']."' WHERE `steam_id`='".$steamprofile['steamid']."'");
		echo "username updated!";
	}
	

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
		echo "after marketable usw";
		

		$item_id = $item['classid']; // unique identification
		
		$item_already_in_db = mysqli_query($db, "SELECT 1 FROM `items` WHERE `item_id`='".$item_id."'");

		
		if(mysqli_num_rows($item_already_in_db) == 0){
				
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
			
			mysqli_query($db, "INSERT INTO `items` VALUES ('".$item_id."', '".$item_name."', '".$icon_url."', '".$exterior."', '".$rarity."')");
			echo "INSERT DONE!";
		}

		
			
		
	}
	
	
}


/*

for($rg_count = 0; $rg_count < $length; $rg_count++){
	$item = $decoded_inv['rgDescriptions'][$rg_count];
	echo "Item #".$rg_count;
	print_r($item);
}

*/

//print_r($success);

if($success == 1){
	echo "Success!";	
} else {
	echo "No success :/";
}

$username_result = mysqli_query($db, "SELECT * FROM `users` WHERE `steam_id`='".$steamprofile['steamid']."'");
$test = mysqli_fetch_object($username_result);


//REDIRECT WORKING!
header("Location: /");
die("Stop ignoring my headers!");

?>