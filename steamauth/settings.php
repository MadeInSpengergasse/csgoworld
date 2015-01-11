<?php
$api_key = "63252DD193BA385C195067BF5217B61E"; // Your Steam WebAPI-Key found at http://steamcommunity.com/dev/apikey
$domainname = "csgoworld.me"; // The main URL of your website displayed in the login page
$button_style = "small"; // Style of the login button [small|large_no|large]
$logout_page = "index.php"; // Page to redirect to after a successfull logout (from the root folder of your website) REMOVED IN SOURCE

// System stuff
if (empty($api_key)) {die("<div style='display: block; width: 100%; background-color: red; text-align: center;'>SteamAuth:<br>Please supply a API-Key!</div>");}
if (empty($domainname)) {$domainname = "localhost";}
if ($button_style != "small" and $button_style != "large_no" and $button_style != "large") {$button_style = "large_no";}
$logout_page = "..".$logout_page;
?>