<?php
	session_start();
	include("includes/connect.php");

	if(!isset($_SESSION['username'])){
		header("location: index.php");
	}
	else {
		include("user_navigation.php");
		include("body.php");
	}
?>