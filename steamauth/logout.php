<?php
include("settings.php");
//header("Location: ./".$logout_page);
header("Location: /index.php");
session_start();
unset($_SESSION['steamid']);
unset($_SESSION['steam_uptodate']);
?>