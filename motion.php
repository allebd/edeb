<?php
	session_start();
	include("includes/connect.php");

	$useridx=$_GET['userid'];
	$comid=$_GET['comid'];
	$motion=$_GET['motion'];

	if(!isset($_SESSION['admin_username']))
	{
		$userid=$_SESSION["userid"];
	}else{
		$userid=$_SESSION["admin_userid"];
	}	

	$sql="INSERT INTO motion(user_id,com_id,motion)VALUES('$userid','$comid','$motion')";
	$sora=mysql_query($sql);

	if($motion=="support")
	{
		echo"
		<div id='sup".$comid."'>
		<button id='support' class='unsupport'>SUPPORTED</button>
		</div>";
	}else{
		echo"
		<div id='opp".$comid."'>
		<button id='oppose' class='unoppose'>OPPOSED</button> 
		</div>
		";
	}
?>