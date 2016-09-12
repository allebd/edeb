<?php 
include("connect.php");
session_start();


if(isset($_GET['result'])){

$userid1=$_SESSION['admin_userid'];



	echo"
	<div id='sarah'>";



		$getdiscuss = "SELECT * FROM discussion";

		$rundiscuss = mysql_query($getdiscuss);
		while($row_discuss = mysql_fetch_array($rundiscuss)){

		$discussid = $row_discuss['discussion_id'];
		$userid = $row_discuss['user_id'];
		$categoryid = $row_discuss['category_id'];
		$title = $row_discuss['topic'];
		$description = $row_discuss['description'];

		$user = "SELECT * FROM registrationtbl WHERE user_id= '$userid'";

		$run_user = mysql_query($user); 
		$row_user = mysql_fetch_array($run_user);
		$user_name = $row_user['username'];

		
			$starter=$user_name;
			$title;
			$description;		






			echo "<hr>
		<h3>$title</h3>
		
		";






	$query = "SELECT * FROM comment WHERE discussion_id='$discussid' ORDER BY comment_id DESC";
	$result = mysql_query($query);


	while ($row = mysql_fetch_array($result)) {
		$user_comment = $row['comment'];
		$commentid = $row['comment_id'];
		$idon=$row['user_id'];
		$disco =$row['discussion_id'];
		
		
		
		
	$getname = "SELECT * FROM registrationtbl WHERE user_id='$idon'";
		$runname = mysql_query($getname);
		if(mysql_num_rows($runname) > 0)
		{			
			$rowname = mysql_fetch_array($runname);
			$usernamoo = ucwords(strtolower($rowname['username']));
		}else{
			$getname = "SELECT * FROM admin WHERE admin_id='$idon'";
			$runname = mysql_query($getname);
			$rowname = mysql_fetch_array($runname);
			$usernamoo = ucwords(strtolower($rowname['admin_username']));
		}
		
		$dede ="SELECT * FROM motion WHERE com_id ='$commentid' AND motion='support'";
		$ruo=mysql_query($dede);
		$supnum=mysql_num_rows($ruo);
		
		$dede2 ="SELECT * FROM motion WHERE com_id ='$commentid' AND motion='oppose'";
		$ruo2=mysql_query($dede2);
		$oppnum=mysql_num_rows($ruo2);

		
			echo "
			<b style='font-size:15px; font-weight:bold;'>".
		$usernamoo."'s</b> <small> comment : </small>
				". 
					$user_comment.
				"<br><br>
				
<button id='support'>$supnum SUPPORT</button> 
       
<button id='oppose'>$oppnum OPPOSE</button>
		        <br><br>
			";
	}
	
		}
	
	echo"
	</div>
	";

        }
		
		

?>
