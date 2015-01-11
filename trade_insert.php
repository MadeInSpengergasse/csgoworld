<?php

require ('steamauth/steamauth.php');


if(!isset($_SESSION['steamid'])) {
	exit("Please log in first!");	
}

include ('steamauth/userInfo.php');


$db = mysqli_connect("localhost", "csgoworld", "", "csgoworld");
if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}

$trade_id_query = mysqli_query($db, "SELECT MAX(trade_id) AS max_id FROM `trades`");
$row_trade_id_query = mysqli_fetch_object($trade_id_query);

$trade_id = $row_trade_id_query->max_id;
$trade_id++;

print_r($_POST);

$counter = 0;

foreach( $_POST as $key => $value ) {
    
	print_r($value);
	
	if (strpos($key,'w') !== false) {
		
		mysqli_query($db, "INSERT INTO `trades_want` (user_id, trade_id, item_id) VALUES ('".$steamprofile['steamid']."', '".$trade_id."', '".$value."')");
		echo "want inserted";
		
	} elseif (strpos($key,'h') !== false) {
			
		mysqli_query($db, "INSERT INTO `trades_have` (user_id, trade_id, item_id) VALUES ('".$steamprofile['steamid']."', '".$trade_id."', '".$value."')");
		echo "have inserted";
		
	} elseif ($key == "comment"){
		
		mysqli_query($db, "INSERT INTO `trades` (trade_id, comment, user_id) VALUES ('".$trade_id."', '".$value."', '".$steamprofile['steamid']."')");
		echo "comment inserted";
	}
	
	$counter++;
	
}



?>