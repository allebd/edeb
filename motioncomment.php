<?php
	session_start();
	include("includes/connect.php");

	$discussionid = $_POST['discussion_id'];
	$comid=$_GET['mycomid'];
	$motion=$_POST['reason'];

	if(!isset($_SESSION['admin_username']))
	{
		$userid=$_SESSION["userid"];
	}else{
		$userid=$_SESSION["admin_userid"];
	}	

	$sql="INSERT INTO motioncomment (user_id,com_id,comment)VALUES('$userid','$comid','$motion')";
	$sora=mysql_query($sql);

	if(!isset($_SESSION['admin_username']))
	{
		header("Location:users/home.php?comment&discussion_id=$discussionid");
	}else{
		header("Location:admin/home.php?comment&discussion_id=$discussionid");
	}
?>