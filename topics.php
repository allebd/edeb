<?php 
	if(isset($_GET['topics']))
	{
		$get = "SELECT * FROM discussion";
		$run = mysql_query($get);

		while($row = mysql_fetch_array($run))
		{
			$discussionid = $row['discussion_id'];
			$userid = $row['user_id'];
			$categoryid = $row['category_id'];
			$usertopic = $row['topic'];
			$userdescription = $row['description'];

			$user = "SELECT * FROM registrationtbl WHERE user_id = '$userid'";
			$runn = mysql_query($user);

			if(mysql_num_rows($runn) > 0)
			{
				$row_user = mysql_fetch_array($runn);
				$user_name = ucwords(strtolower($row_user['username']));
			}else{
				$user = "SELECT * FROM admin WHERE admin_id = '$userid'";
				$runn = mysql_query($user);
				$row_user = mysql_fetch_array($runn);
				$user_name = ucwords(strtolower($row_user['admin_username']));
			}
			

			echo "
				<div>
					<h3>Started by: $user_name</h3>
					<strong>$usertopic:</strong> $userdescription
					<a href='home.php?comment&discussion_id=$discussionid' class='btn btn-primary btn-sm' style='float: right;'>Comment</a>
					<hr>
				<div>
			"; 
		}
	}
?>