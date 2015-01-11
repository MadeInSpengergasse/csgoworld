<?php
/************************************************
	The Search PHP File
************************************************/


/************************************************
	MySQL Connect
************************************************/
// Credentials
$dbhost = "localhost";
$dbname = "csgoworld";
$dbuser = "csgoworld";
$dbpass = "";

//	Connection
global $db;

$db = new mysqli();
$db->connect($dbhost, $dbuser, $dbpass, $dbname);
$db->set_charset("utf8");

//	Check Connection
if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}
/************************************************
	Search Functionality
************************************************/

// Define Output HTML Formating
$html = '';
//$html .= '<li class="result">';
$html .= "<img onmouseover=\"nhpup.popup('item_name (item_exterior)<br><br>item_rarity');\" src=\"http://steamcommunity-a.akamaihd.net/economy/image/icon_url/99fx66f\" alt=\"Picture not found!\" class=\"img\" data-id=\"item_id\" onClick=\"addTrade('false', this);\">";
//$html .= '</li>';

// Get Search

$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = $db->real_escape_string($search_string);

// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	
	
	// Build Query
	$query = 'SELECT * FROM `items` WHERE `item_name` LIKE "%'.$search_string.'%" LIMIT 100';
	// Do Search
	$result = $db->query($query);
	while($results = $result->fetch_array()) {
		$result_array[] = $results;
	}

	// Check If We Have Results
	if (isset($result_array)) {
		foreach ($result_array as $result) {

			// Format Output Strings And Hightlight Matches
			//$display_function = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['function']);
			
			//$display_pic = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['icon_url']);
			//$display_name = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['item_name']);
			//$display_exterior = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['item_exterior']);
			//$display_rarity = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['item_rarity']);
			$display_name = $result['item_name'];
			$display_pic = $result['icon_url'];
			$display_exterior = $result['item_exterior'];
			$display_rarity = $result['item_rarity'];
			$display_id = $result['item_id'];
			
			
			
			// Insert Name
			$output = str_replace('item_name', $display_name, $html);

			// Insert Pic
			$output = str_replace('icon_url', $display_pic, $output);
			
			if($display_exterior == ""){
					$output = str_replace('(item_exterior)', '', $output);
			} else {

			// Insert Exterior
			$output = str_replace('item_exterior', $display_exterior, $output);
			}
			
			// Insert Rarity
			$output = str_replace('item_rarity', $display_rarity, $output);
			
			// Insert ID
			$output = str_replace('item_id', $display_id, $output);

			// Output
			echo($output);
		}
	}else{

		// Format No Results Output
		$output = "<a>Nothing found :(</a><br><a>Note that only items are displayed, which other users have/had in their inventory!</a>";

		// Output
		echo($output);
	}
}


/*
// Build Function List (Insert All Functions Into DB - From PHP)

// Compile Functions Array
$functions = get_defined_functions();
$functions = $functions['internal'];

// Loop, Format and Insert
foreach ($functions as $function) {
	$function_name = str_replace("_", " ", $function);
	$function_name = ucwords($function_name);

	$query = '';
	$query = 'INSERT INTO search SET id = "", function = "'.$function.'", name = "'.$function_name.'"';

	$db->query($query);
}
*/
?>