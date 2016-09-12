<?php
	session_start();
	include("includes/connect.php");

	$ireport_id=$GET['report'];
	if(!isset($_SESSION['admin_username']))
	{
		header("location:../index.php");
	}

	$sql="UPDATE ireport SET status='approved' WHERE ireport_id='$ireport_id'";
	$sora=mysql_query($sql);

	echo $sql;

	
	header("Location:home.php?ireport");
?>