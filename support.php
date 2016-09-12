<?php

session_start();
include("connect.php");


$userid=$_GET['userid'];
$comid=$_GET['comid'];
$motion="support";

$sql="INSERT INTO motion(user_id,com_id,motion)VALUES('$userid','$comid','$motion')";
$sora=mysql_query($sql);

if($motion=="support"){
echo"
				<div id='mot".$commentid."'>
<button id='support' onClick='motionrevoke($id,$commentid,$support)'>SUPPORTED</button>
</div> 
";
}else{
echo"

				<div id='mot".$commentid."'>
<button id='oppose' onClick='motionrevoke($id,$commentid,$support)'>OPPOSED</button> 
</div>
";
}
?>