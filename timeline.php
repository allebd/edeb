<div id="page-wrapper">
    
        <div class="row">
            <div class="col-lg-10">
                <div class="panel-group" id="accordion" style="padding-top: 100px;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    Ministry of Works
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <?php 
                                            include("connect.php");

                                            $get = "SELECT * FROM discussion WHERE category_id = '1'";
                                            $run = mysql_query($get);
                                            while($row = mysql_fetch_array($run)){
                                                $usertopic = $row['topic'];
                                                $discussionid = $row['discussion_id'];
                                                $description = $row['description'];
                                              
                                                echo "<a href='discussion.php?discussion_id=$discussionid'>$usertopic <br>
                                                </a>
                                                $description
                                                  <hr>
                                                ";
                                            }

                                        ?>
                                    </div>                        
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    Ministry of Power
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <?php 
                                            include("connect.php");

                                            $get2 = "SELECT * FROM discussion WHERE category_id ='2'";
                                            $run2 = mysql_query($get2);
                                            while($row2 = mysql_fetch_array($run2)){
                                                $usertopic2 = $row2['topic'];
                                                $discussionid2 = $row2['discussion_id'];
                                                $description2 = $row2['description'];
                                              
                                                echo "<a href='discussion.php?discussion_id=$discussionid2'>$usertopic2 <br>
                                                </a>
                                                $description2
                                                  <hr>
                                                ";
                                            }

                                        ?>
                                    </div>
                                          
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                    Ministry of Housing
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <?php 
                                            include("connect.php");

                                            $get3 = "SELECT * FROM discussion WHERE category_id = '3'";
                                            $run3 = mysql_query($get3);
                                            while($row3 = mysql_fetch_array($run3)){
                                                $usertopic3 = $row3['topic'];
                                                $discussionid3 = $row3['discussion_id'];
                                                $description3 = $row3['description'];
                                              
                                                echo "<a href='discussion.php?discussion_id=$discussionid3'>$usertopic3 <br>
                                                </a>
                                                $description3
                                                  <hr>
                                                ";
                                            }

                                        ?>
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="discussion.php"> Create a new discussion</a>

</div>


<script type="text/javascript" src="asset/js/jquery.js"></script>
<script type="text/javascript" src="asset/js/bootstrap.min.js"></script>

</body>
</html>