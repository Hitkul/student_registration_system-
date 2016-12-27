<?php
session_start();
include("mysqli_connect.php");
$foo = 1;
$id = $_SESSION['id'];
$query = "UPDATE `reg_status` SET `status`= $foo WHERE `id` ='$id'";
$retval=mysqli_query( $dbc, $query);
mysqli_close($dbc);
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BML Munjal University</title>
    <link rel="shortcut icon" href="images/bml_logo.png">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="js/final.js"></script> -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="javascript">
        $(function(){ $('[data-toggle="tooltip"]').tooltip(); $(".side-nav .collapse").on("hide.bs.collapse", function() { $(this).prev().find(".fa").eq(1).removeClass("fa-angle-right").addClass("fa-angle-down"); }); $('.side-nav .collapse').on("show.bs.collapse",
        function() { $(this).prev().find(".fa").eq(1).removeClass("fa-angle-down").addClass("fa-angle-right"); }); });
    </script>
</head>

<body>
    <div class="container">
        <br>
        <br>
        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron" style=" text-align:center;">
            <div class="row">
                <div class="col-xs-12">
                    <h1>Registeration done</h1>
                </div>
            </div>
        </div>
        <div class="jumbotron jumbotron-fluid" style="background-color:transparent; margin-top:-60px;">
                <div class="form-group row text-xs-center">
                      <div class="col-sm-12">
                        <a href="logout.php"><button class="btn btn-primary">Log out</button></a>
                      </div>
                </div>

        </div>

    </div>
    <!-- /container -->
    <script type="javascript">

    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>
