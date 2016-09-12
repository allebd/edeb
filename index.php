<?php 
        session_start();
        include("includes/connect.php");

        if(isset($_POST['login']))
        {
            $user_name = trim(mysql_real_escape_string($_POST['username']));
            $userpassword = md5(trim(mysql_real_escape_string($_POST['password'])));

            if($user_name == '' || $userpassword == '')
            {
                echo "<script>alert('Kindly fill all fields!!!')</script>";
            }else{
                $query = "SELECT * FROM registrationtbl WHERE username = '$user_name' AND password = '$userpassword'";
                $result = mysql_query($query);
                $check = mysql_num_rows($result); 
                $xz = mysql_fetch_array($result);
                $userid = $xz['user_id'];                

                $admin = "SELECT * FROM admin WHERE admin_username = '$user_name' AND admin_pass = '$userpassword'";
                $admin_result = mysql_query($admin);
                $check_ad = mysql_num_rows($admin_result);
                $xza = mysql_fetch_array($admin_result);
                $aduserid = $xza['admin_id'];                

                if($check > 0)
                {
                    $_SESSION['username'] = $user_name;
                    $_SESSION['userid']  = $userid;
                    header("location:users/home.php?l");
                }else if($check_ad > 0)
                {
                    $_SESSION['admin_username']  = $user_name;
                    $_SESSION['admin_userid']  = $aduserid;
                    header("location:admin/home.php?l");
                }else{
                    echo "<script>alert('User has not been registered!!!')</script>";
                }
            }            
        }

        //signup
        if (isset($_POST['register']))
        {
            $user_name = trim(addslashes(strtoupper($_POST['username'])));
            $first_name = trim(addslashes(strtoupper($_POST['firstname'])));
            $last_name = trim(addslashes(strtoupper($_POST['lastname'])));
            $user_password = md5(trim($_POST['password']));
            $useremail = trim($_POST['email']);
            $user_occupation = trim(addslashes($_POST['occupation']));
            $user_state = trim($_POST['state']);
            $user_date = trim($_POST['dateofbirth']);
            $user_sex = trim($_POST['sex']);
            $visionboard = trim(addslashes($_POST['vision_board']));
            
            if($user_name == '' || $first_name == '' || $last_name == '' || $user_password == '' || $useremail == '' || $user_state == '' || $user_occupation == '' || $user_date == '' || $user_sex == '' || $visionboard == '' )
            {
                 echo "<script>alert('Kindly fill all fields!!!')</script>";
            }else{
                $register = "SELECT * FROM registrationtbl WHERE username = '$user_name'";
                $result = mysql_query($register);
                $check = mysql_num_rows($result);

                if($check == 1)
                {
                    echo "<script>alert('You have already been registered!!!')</script>";
                }else{
                    $insert = "INSERT INTO registrationtbl (username, firstname, lastname, password, email, occupation, state, date_of_birth, sex, vision_board)
                    VALUES ('$user_name', '$first_name', '$last_name', '$user_password', '$useremail', '$user_occupation', '$user_state', '$user_date', '$user_sex', '$visionboard')";

                    $query = mysql_query($insert);
                    if($query)
                    {
                        echo "<script>alert('You have Successfully registered, You can now login!!!')</script>";
                    }else{
                        echo "<script>alert('Kindly register again!!!')</script>";
                    }
                }   
            }           
        }

        $get_state = "SELECT * FROM states";
        $run_state = mysql_query($get_state);
?>
<?php include("views/default.php"); ?>

    <!-- Header -->
    <a name="home"></a>
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Federal Ministry of Power, Works &amp; Housing</h1>                        
                        <hr class="intro-divider">
                        <h3>E-Deliberation site</h3>
                        <ul class="list-inline intro-social-buttons">
                            <li class="quote"></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->


    <!-- /.content-section-a -->
    
    <!-- /.content-section-a -->

	<a  name="deliberate"></a>
    

    <section id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class='modal-title'>Login to E-Deliberation</h4>
                </div>
                <div class="modal-body">
                <form method="post" action="">
                    <div class="form-group">
                         <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                  
                    <div class="form-group">
                        <button class="btn btn-primary btn-md" name="login"> Login</button>
                        <button class="btn btn-primary btn-md" data-dismiss="modal" >Close</button>
                    </div>
                </form>
                </div>
                   
            </div>
        </div>
    </section>

    

    <!-- /.content-section-a -->

            <!-- /.container -->
    <section id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class='modal-title'>Register for E-Deliberation</h4>
                </div>
                <div class="modal-body">
                        <form method="post" action="" >
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="firstname" placeholder="Firstname" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="lastname" placeholder="Lastname" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="occupation" placeholder="Occupation" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control" size="1" name="state" required>
                                    <option selected disabled>Select state</option> 
                                    <?php   
                                        while ($row_state = mysql_fetch_array($run_state)){
                                            $state_id = $row_state['state_id'];
                                            $state = $row_state['state_name'];
                                            echo "<option value='$state'>$state</option>";
                                        }                                        
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control" name="dateofbirth" placeholder="YYYY-MM-DD" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control" size="1" name="sex">
                                    <option selected disabled> Select gender</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                 </select>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="vision_board" cols="25" rows="5" placeholder="Where do you see Nigeria in 10 years" required></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-md" name="register">Register</button>
                                <button class="btn btn-primary btn-md" data-dismiss="modal" >Close</button>
                            </div>

                        </form>
                    </div>
                </div>
                </div>
    </section>
        <!-- /.banner -->

<?php include("views/footer.php"); ?>