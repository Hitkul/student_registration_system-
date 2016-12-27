<?php
session_start();


include("mysqli_connect.php");
if (isset($_SESSION['login_user'])) {
	header("Location: check_status.php", 301);
}else{
	$msg="";
	if (isset($_GET["msg"]) ) {
		$msg= $_GET["msg"];
	}
	if (isset($_POST['yo'])){
		print_r($_POST);
		$username = $_POST['email'];
		$password = $_POST['password'];
		$username = strtolower($username);
		$username = trim($username);

		function enc(&$data){
			$strlen = strlen( $data );
			for( $i = 0; $i < $strlen; $i++ ) {
	    		$data[$i] = chr(ord($data[$i])+3);
	    	}
		}

		enc($password);

		if(empty($username) || empty($password)){
			header("location:index.php?msg=Wrong Username or Password");
		}else{
			$query = "SELECT * FROM log_in WHERE username LIKE '$username' and password LIKE '$password'";

			$response = mysqli_query($dbc, $query);
			$row = mysqli_fetch_array($response,MYSQLI_ASSOC);
	    $count = mysqli_num_rows($response);

			if($count == 1){
				$_SESSION['login_user'] = $username;
				$query = "SELECT * FROM `student_info` WHERE username LIKE '$username'";
				$response = mysqli_query($dbc, $query);
				$row = mysqli_fetch_array($response,MYSQLI_ASSOC);
				$_SESSION['id'] = $row['id'];
				$_SESSION['first_name'] = $row['first_name'];
				$_SESSION['last_name'] = $row['last_name'];
				$_SESSION['stream'] = $row['stream'];
				$_SESSION['semester'] = $row['semester'];
				header("location: check_status.php");
			}else{
				header("location:index.php?msg=Wrong Username or Password");
			}
		}
	}
}
mysqli_close($dbc);
?>
<!DOCTYPE html>
<html>

<head>
    <title>BML Munjal University</title>
    <meta charset="utf-8">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="name" content="content">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="shortcut icon" href="images/bml_logo.png" type="image/png">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="css/style.css" media="screen,projection" />
    <script type="javascript">
        $(".button-collapse").sideNav();
        }
    </script>
    <script type="javascript" src="js/index.js"></script>
</head>

<body>
    <div class="navnar-fixed">
        <nav class="grey darken-4 z-depth-4">
            <div class="nav-wrapper">
                <a style="font-size:18px; padding-left:8px;">BML Munjal University</a>
            </div>
        </nav>
    </div>
    <div class="section"></div>

    <main>
        <center>
            <h5 class="indigo-text">Please, login into your account</h5>
            <div class="section"></div>

            <div class="container">
                <div class="z-depth-4 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                    <form class="col s12" method="post" name="loginform">
                        <div class="row">
                            <div class="input-field col s12 center">
                                <img src="images/ic_account_circle_black_48dp_2x.png" alt="" class="circle responsive-img valign profile-image-login">
                            </div>
                        </div>

												<p style="color:red;padding-left: 30px;"><?php echo $msg; ?></p>
                        <!-- <div class='row'>
                            <div class='col s12'>
                            </div>
                        </div> -->

                        <div class="row" style="text-align:left;">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">email</i>
                                <input class = "validate" type='text' name='email'/>
                                <label for="email">Enter your email</label>
                            </div>
                        </div>

                        <div class="row" style="text-align:left;">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">lock_outline</i>
                                <input class="validate" type="password" name="password" id="password" />
                                <label for='password'>Enter your password</label>
                            </div>

                            
                            <!-- <label class="row">
                              <p style="float: left;">
                                <input type="checkbox" id="remember_me" />
                                <label for="remember_me"><b class="blue-text">Remember me</b></label>
                              </p>
                              <p style='float: right;'>
                                <a href="#!"><b class="blue-text">Forgot Password?</b></a>
                              </p>
                            </label> -->
                        </div>



                        <center>
                            <div class='row'>
															<input type='submit' name='yo' class='col s12 btn btn-large waves-effect waves-light' style="background:#337ab7;" value="Login"></input>
																<!-- <input type='submit' name='btn_login' class='col s12 btn btn-large waves-effect waves-light' id="submit_button" style="background:#337ab7;" value="Login"></input> -->
                            </div>
                        </center>
                    </form>
                </div>
            </div>

            <!-- <b><label>Not a member?<a href="dashboard.html" class="tooltipped" data-position="top" data-delay="50" data-tooltip="New Student?"> Register Now</a></label></b> -->
            <!-- <div class="container">
                <div class="z-depth-4 grey lighten-4 row" style="display: inline-block;padding: 20px 20px 0px 20px; border: 1px solid #EEE;">
                    <label class="col s12" style="text-align:center; width:100%; display: inline-block;">
                        <div class='row'>
                            <div class='col s12'>

                            </div>
                        </div>
                    </label>
                </div>
            </div> -->
            </div>

        </center>

        <div class="section"></div>
        <div class="section"></div>
    </main>
    <script type="javascript">
    $(document).ready(function(){
      // function validateForm(){
      //   var x=document.forms["loginform"]["email"].value;
      //   // var y=document.forms["loginform"]["password"].value;
      //   if (x==null || x=="") {
      //     alert("Please enter email and password");
      //     return false;
      //   }
    });

    </script>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
