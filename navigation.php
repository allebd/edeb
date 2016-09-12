<?php 
    $currentuser = $_SESSION['username'];
    $query = "SELECT * FROM registrationtbl WHERE username = '$currentuser'";
    $result = mysql_query($query);

    $row = mysql_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome <?php echo $row['username'];?></title>

    <!-- Bootstrap Core CSS -->
    <link href="../asset/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../asset/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <!--link href="css/plugins/morris.css" rel="stylesheet"-->

    <!-- Custom Fonts -->
    <link href="../asset/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-left top-nav">
                
                <li>
                    <a href="aboutus.php"> About us </a>
                </li>
                <li>
                    <a href="home.php" >Deliberation Forum </a>
                </li>
                <li>
                    <a href= '#'>iReport</a>
                </li>
                <li>
                    <a href= '#'>Polls</a>
                </li>
                <li>
                    <a href= '#'> Project Board</a>
                </li>
            </ul>      
            
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $row['username'];?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    
    </div>