<script>
	function motionsupport(x,y){
		var x = x;
		var y = y;
		var z = "support";
		var fiz = "#mot" + y;

	    $(fiz).fadeOut(250);
		$.ajax({
			url: "../motion.php",
			method: "GET",
			data: "userid="+ x +"& comid="+ y +"& motion="+ z ,
		success: function(result){
	    	$(fiz).html(result);
	        $(fiz).fadeIn(250);
	        window.location.reload(false);
		},
		error: function(){
			alert("couldnt complete action");
		}
		});
	}

	function motionoppose(x,y){
		var x=x;
		var y=y;
		var z="oppose";
		var fiz="#mot" + y;
	    $(fiz).fadeOut(250);
		$.ajax({
			url: "../motion.php",
			method: "GET",
			data: "userid="+ x +"& comid="+ y +"& motion="+ z ,
		success: function(result){
	        $(fiz).html(result);
	        $(fiz).fadeIn(550);
	        window.location.reload(false);
		},
		error: function(){
			alert("couldnt complete action");
		}
		});
	}

	// function submitme(x,y)
	// {
	// 	var fiz = "#reason" + x;
 //    	$.ajax({
	// 		url: "../motioncomment.php",
	// 		method: "GET",
	// 		data: "discussion_id="+ y +"&comid="+ x +"&reason="+ $(fiz).val(),
	// 	success: function(result){
	//         window.location.reload(false);
	// 	},
	// 	error: function(){
	// 		alert("couldnt complete action");
	// 	}
	// 	});
 //    }
</script>

<?php
	include("../includes/connect.php");

	if(!isset($_SESSION['admin_username']))
	{
		$userid1=$_SESSION["userid"];
	}else{
		$userid1=$_SESSION["admin_userid"];
	}	

	global $discussid;
	global $start_date;
	//global $commentid;
	if(isset($_GET['discussion_id']))
	{

		$getid = $_GET['discussion_id'];
		$getdiscuss = "SELECT * FROM discussion WHERE discussion_id = '$getid'";

		$rundiscuss = mysql_query($getdiscuss);
		$row_discuss = mysql_fetch_array($rundiscuss);

		$discussid = $row_discuss['discussion_id'];
		$userid = $row_discuss['user_id'];
		$categoryid = $row_discuss['category_id'];
		$title = $row_discuss['topic'];
		$description = $row_discuss['description'];
		$start_date = $row_discuss['startdate'];
		$end_date = $row_discuss['enddate'];

			$user = "SELECT * FROM registrationtbl WHERE user_id = '$userid'";

			$run_user = mysql_query($user); 

			if(mysql_num_rows($run_user) > 0)
			{
				$row_user = mysql_fetch_array($run_user);
				$user_name = $row_user['username'];				
			}else{
				$user = "SELECT * FROM admin WHERE admin_id = '$userid'";

				$run_user = mysql_query($user); 
				$row_user = mysql_fetch_array($run_user);
			}

			if(!isset($_SESSION['admin_username']))
			{
				$user_sess = $_SESSION['username'];
				$get_sess = "SELECT * FROM registrationtbl WHERE username = '$user_sess'";
				$run_sess = mysql_query($get_sess);

				$row_sess = mysql_fetch_array($run_sess);
				$user_sessid = $row_sess['user_id'];
				$user_sessname = $row_sess['username'];
			}else{
				$user_sess = $_SESSION['admin_username'];
				$get_sess = "SELECT * FROM admin WHERE admin_username = '$user_sess'";
				$run_sess = mysql_query($get_sess);

				$row_sess = mysql_fetch_array($run_sess);
				$user_sessid = $row_sess['admin_id'];
				$user_sessname = $row_sess['admin_username'];
			}	
		

		//now displaying all at once 
		echo "<div style= 'text-align: justify;'>		
			<h3>Started by: $user_name</h3> 
			<h4>$title</h4>
			<p>$description</p><hr>
			</div>
		";
	}

	if(isset($_POST['send']))
	{
		$discussid = $_POST['disco'];
		$user_comment = trim(addslashes($_POST['u_comment']));

		if(!isset($_SESSION['admin_username']))
		{
			$username = $_SESSION['username'];
		}else{
			$username = $_SESSION['admin_username'];
		}
		

		if(!isset($_SESSION['admin_username']))
		{
			$get_com = "SELECT * FROM registrationtbl WHERE username = '$username'";
			$res_com = mysql_query($get_com);
			$row_com=mysql_fetch_array($res_com);
			$username = $row_com['username'];
		}else{
			$get_com = "SELECT * FROM admin WHERE admin_username = '$username'";
			$res_com = mysql_query($get_com);
			$row_com=mysql_fetch_array($res_com);
			$username = $row_com['admin_username'];
		}
		

		if($user_comment == '')
		{
			echo "<script>alert('Motion cannot be proposed!!!')</script>";
		}else{
			$insert = "INSERT INTO comment(discussion_id, user_id, comment) VALUES('$discussid', '$userid1', '$user_comment')";
			$result = mysql_query($insert);
			if ($result) {
				echo "<script>alert('Motion has been proposed!!!')</script>";
			}
		}		
	}

	/*Comments function*/
	$get_id = $_GET['discussion_id'];

	$query = "SELECT * FROM comment WHERE discussion_id='$get_id' ORDER by 1 DESC";
	$result = mysql_query($query);

	//get from comment table
	echo "<div id='sarah'>";

	while ($row = mysql_fetch_array($result))
	{
		$user_comment = $row['comment'];
		$commentid = $row['comment_id'];
		$id = $row['user_id'];

		//$reply = $row['reply'];
		//end from commment table and start from reply table

			$getname = "SELECT * FROM registrationtbl WHERE user_id = '$id'";
			$runname = mysql_query($getname);

			if(mysql_num_rows($runname) > 0)
			{
				$rowname = mysql_fetch_array($runname);
				$usernam = ucwords(strtolower($rowname['username']));
			}else{
				$getname = "SELECT * FROM admin WHERE admin_id = '$id'";
				$runname = mysql_query($getname);
				$rowname = mysql_fetch_array($runname);
				$usernam = ucwords(strtolower($rowname['admin_username']));
			}
		
		echo "<p><strong style='font-size:19px;'>".
				$usernam."</strong><br>". 
					$user_comment.
				"</p>";


		$dede ="SELECT * FROM motion WHERE user_id ='$userid1' AND com_id ='$commentid'";
				$ruo=mysql_query($dede);
				$moo=mysql_num_rows($ruo);
				$zxz=mysql_fetch_array($ruo);
				$moso=$zxz['motion'];

		$getmcomment = "SELECT username, comment, m.user_id AS theid FROM motioncomment m INNER JOIN registrationtbl r ON m.user_id = r.user_id WHERE com_id ='$commentid'";
		$gettingmcomment = mysql_query($getmcomment);


		echo "<p><span><strong style='font-size:14px;'>Comments</strong></span><br>";

		if(mysql_num_rows($gettingmcomment) > 0)
		{			
			while($mrow = mysql_fetch_array($gettingmcomment))
			{
				$mcomuser = $mrow['theid'];
				$mcomnm = ucwords(strtolower($mrow['username']));
				$mcomm = $mrow['comment'];
				echo "<strong>$mcomnm:</strong> $mcomm<br>";
			}
			$mcomment = "Motion Commented";
		}else{
				$mcomment = "Motion Not Commented";
		}


			$getmcomment = "SELECT admin_username, comment, m.user_id AS theid FROM motioncomment m INNER JOIN admin a ON m.user_id = a.admin_id WHERE com_id ='$commentid'";
			$gettingacomment = mysql_query($getmcomment);

			if(mysql_num_rows($gettingacomment) > 0)
			{
				while($arow = mysql_fetch_array($gettingacomment))
				{
					$mcomuser = $arow['theid'];
					$mcomnm = ucwords(strtolower($arow['admin_username']));
					$mcomm = $arow['comment'];
					echo "<strong>$mcomnm:</strong> $mcomm<br>";
				}
				$mcomment = "Motion Commented";
			}else{
				$mcomment = "Motion Not Commented";
			}

			echo "</p>";
		

		$getmycomment = "SELECT * FROM motioncomment WHERE user_id ='$userid1' AND com_id ='$commentid'";
		$gettingmycomment = mysql_query($getmycomment);
		if(mysql_num_rows($gettingmycomment) > 0)
		{	
			$mycomment = "Motion Commented";
		}else{
			$mycomment = "Motion Not Commented";
		}

		if($moo > 0)
		{
			if($moso=="support")
			{
				echo"
					<div id='sup".$commentid."'>
				<button id='support' >SUPPORTED</button>";
				if($mycomment == "Motion Not Commented")
				{
					echo "<a class='motioncomment'  data-toggle='modal' data-target='#motion-comment' href='#' >COMMENT</a>
						<!-- Modal Confirmation -->
						<section id='motion-comment' class='modal fade' tabindex='-1' role='dialog' aria-hidden='true'>
			                <div class='modal-dialog'>
			                    <div class='modal-content'>
			                    <form method='post' class='theform' action='../motioncomment.php?mycomid=$commentid'>
			                        <div class='modal-header'>
			                        	<h4 class='modal-title' style='color:#000'>Comment</h4>
			                        </div>
			                        <div class='modal-body'>
			                        	<input type='hidden' name='discussion_id' value='$get_id' >
			                            <textarea required name='reason' id='reason".$commentid."' class='form-control' style='border:2px solid #e7e7e7'></textarea>
			                        </div>
			                        <div class='modal-footer'>
	                                    <button type='submit' class='btn btn-primary' value='thecomment".$commentid."' >Send</button>             
	                                    <button type='button' class='btn btn-primary' data-dismiss='modal'>Cancel</button>                                                     
	                                </div>
	                            </form>
			                    </div>
			                </div> 
			            </section>
	                    <!-- End of Modal Confirmation -->";
				}
				echo "</div>";
			}else{
				echo"
					<div id='opp".$commentid."'>
				<button id='oppose' >OPPOSED</button>"; 
				if($mycomment == "Motion Not Commented")
				{
					echo "<a class='motioncomment'  data-toggle='modal' data-target='#motion-comment' href='#' >COMMENT</a>
						<!-- Modal Confirmation -->
						<section id='motion-comment' class='modal fade' tabindex='-1' role='dialog' aria-hidden='true'>
			                <div class='modal-dialog'>
			                    <div class='modal-content'>
			                    <form method='post' class='theform' action='../motioncomment.php?mycomid=$commentid'>
			                        <div class='modal-header'>
			                        	<h4 class='modal-title' style='color:#000'>Comment</h4>
			                        </div>
			                        <div class='modal-body'>			                        	
			                        	<input type='hidden' name='discussion_id' value='$get_id' >
			                            <textarea required name='reason' id='reason".$commentid."' class='form-control' style='border:2px solid #e7e7e7'></textarea>
			                        </div>
			                        <div class='modal-footer'>
	                                    <button type='submit' class='btn btn-primary' value='thecomment".$commentid."' >Send</button>             
	                                    <button type='button' class='btn btn-primary' data-dismiss='modal'>Cancel</button>                                                     
	                                </div>
	                            </form>
			                    </div>
			                </div> 
			            </section>
	                    <!-- End of Modal Confirmation -->";
				}
				echo "</div>";
			}
		}else{
				$support = "support";
				$oppose = "oppose";
				echo "
					<div id='mot".$commentid."'>
						<button id='support' onClick='motionsupport($id,$commentid)'>SUPPORT MOTION</button> 
						<button id='oppose' onClick='motionoppose($id,$commentid)'>OPPOSE MOTION</button>
						";
				if((($mcomment == 'Motion Commented') && ($mcomuser != $userid1)) || ($mcomment == 'Motion Not Commented'))
				{
					echo "<a class='motioncomment'  data-toggle='modal' data-target='#motion-comment' href='#' >COMMENT</a>
						<!-- Modal Confirmation -->
						<section id='motion-comment' class='modal fade' tabindex='-1' role='dialog' aria-hidden='true'>
			                <div class='modal-dialog'>
			                    <div class='modal-content'>
			                    <form method='post' class='theform' action='../motioncomment.php?mycomid=$commentid'>
			                        <div class='modal-header'>
			                        	<h4 class='modal-title' style='color:#000'>Comment</h4>
			                        </div>
			                        <div class='modal-body'>
			                        	<input type='hidden' name='discussion_id' value='$get_id' >
			                            <textarea required name='reason' id='reason".$commentid."' class='form-control' style='border:2px solid #e7e7e7'></textarea>
			                        </div>
			                        <div class='modal-footer'>
	                                    <button type='submit' class='btn btn-primary' value='thecomment".$commentid."' >Send</button>             
	                                    <button type='button' class='btn btn-primary' data-dismiss='modal'>Cancel</button>                                                     
	                                </div>
	                            </form>
			                    </div>
			                </div> 
			            </section>
	                    <!-- End of Modal Confirmation -->";
				}
				echo "</div>
					";
			}			
			echo "<hr>";
		}
 
		$dt = Date("Y-m-d");

		if( $dt >= $end_date)
		{
			echo "<br><p class='enddiscuss'>This discussion ended on ".date_format(date_create($end_date), 'l jS \of F, Y')."</p>";
	 	}else{ 
?>
		<br><br>
		<p class='ntenddiscuss'>This discussion ends by <?php echo date_format(date_create($end_date), 'l jS \of F, Y'); ?></p>

		<form method='post' action=''>
			<div class='row'>
				<div class='col-md-6'>
					<div class='form-group'>
						<input type='hidden' name='disco' value="<?php   
						if(isset($_GET['discussion_id'])){
							$getid = $_GET['discussion_id'];
							 echo $getid;
							 } ?>">
						<textarea name='u_comment' class='form-control' rows='8' placeholder='Propose a motion' required></textarea>
					</div>
				</div>
			</div>
			<button class='btn btn-primary btn-sm' name='send'>PROPOSE MOTION</button>
		</form> 
<?php
		}
	echo "</div>";
?>