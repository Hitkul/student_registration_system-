<?php
session_start();
?>

<?php
//TODo add core elctive and open electives
include("mysqli_connect.php");
session_start();
$sem  = $_SESSION['semester'];
$stream = $_SESSION['stream'];
$flag_core_elective = 1;
$flag_open_elective = 1;
$core_elective = array();
$open_elective = array();

$query = "SELECT * FROM `course` WHERE stream LIKE '$stream' and sem LIKE '$sem'";
$response = mysqli_query($dbc, $query);
//extracting core and open electives

function retrive_core_elective($sem, $stream, $dbc, &$core_elective){
	$query = "SELECT * FROM `core_elective_course` WHERE sem LIKE '$sem' AND stream LIKE '$stream'";
	$response = mysqli_query($dbc, $query);
	while($row = mysqli_fetch_array($response)){
		array_push($core_elective, $row['name']);
	}

}

function retrive_open_elective($dbc,&$open_elective){

	$query = "SELECT * FROM `open_elective_course`";
	$response = mysqli_query($dbc, $query);
	while($row = mysqli_fetch_array($response)){
		array_push($open_elective, $row["name"]);
	}

}

while($row = mysqli_fetch_array($response)){

	if ($row['type'] == 'Core Elective' && $flag_core_elective == 1) {
		retrive_core_elective($sem, $stream, $dbc, $core_elective);
		$flag_core_elective = 0;
	}

	if ($row['type'] == 'Open Elective' && $flag_open_elective == 1) {
		retrive_open_elective($dbc, $open_elective);
		$flag_open_elective = 0;
	}

}


mysqli_data_seek($response, 0);
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
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/dashboard.css" media="screen" title="no title">
    <script type="text/javascript" src="js/dashboard.js"></script>
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
    <!--<div id="throbber" style="display:none; min-height:120px;"></div>-->
    <!--<div id="noty-holder"></div>-->
		<input type="hidden" name="semester" id = "this_is_not_how_you_do_it" value="<?=$_SESSION['semester'];?>"></input>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-dark navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
                <label class="navbar-brand"  href="#!">
                  <!-- style="border-right: 1px solid #FFFFFF;padding-right :30px;" -->
                    <h4 style="text-align:center; padding-top:5px; color:#ffffff;">BML Munjal University </h4>
                </label>
            </div>
            <h4 class="navbar-topic"style="float:center; display:inline-block; position:absolute; left:45%; color:#FFFFFF;">Student Registeration System</h4>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle profile-image" data-toggle="dropdown">  <?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];?><img src="images/user.png" class="img-circle special-img" alt="Cinque Terre" width="30" height="30">&nbsp;<b class="fa fa-angle-down"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <ul id="progress" style="margin-top:75px;margin-left:20px;padding-left: 20px;">
											<li>
													<div class="node green"></div>
													<p>Verification</p>
											</li>
											<li>
													<div class="divider green"></div>
											</li>
											<li>
													<div class="divider green"></div>
											</li>
												<li>
                            <div class="node green"></div>
                            <p>Select Courses</p>
                        </li>
                        <li>
                            <div class="divider grey"></div>
                        </li>
												<li>
                            <div class="divider grey"></div>
                        </li>
                        <li>
                            <div class="node grey"></div>
                            <p>Acadmic Policies</p>
                        </li>
                    </ul>


                    <!-- <li>
                      <a href="#" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-fw fa-search"></i> MENU 1 <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                      <ul id="submenu-1" class="collapse">
                          <li><a href="#"><i class="fa fa-angle-double-right"></i> SUBMENU 1.1</a></li>
                          <li><a href="#"><i class="fa fa-angle-double-right"></i> SUBMENU 1.2</a></li>
                          <li><a href="#"><i class="fa fa-angle-double-right"></i> SUBMENU 1.3</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="#" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-fw fa-star"></i>  MENU 2 <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                      <ul id="submenu-2" class="collapse">
                          <li><a href="#"><i class="fa fa-angle-double-right"></i> SUBMENU 2.1</a></li>
                          <li><a href="#"><i class="fa fa-angle-double-right"></i> SUBMENU 2.2</a></li>
                          <li><a href="#"><i class="fa fa-angle-double-right"></i> SUBMENU 2.3</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="investigaciones/favoritas"><i class="fa fa-fw fa-user-plus"></i>  MENU 3</a>
                  </li>
                  <li>
                      <a href="sugerencias"><i class="fa fa-fw fa-paper-plane-o"></i> MENU 4</a>
                  </li>
                  <li>
                      <a href="faq"><i class="fa fa-fw fa fa-question-circle"></i> MENU 5</a>
                  </li> -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row" id="main">
                    <div class="col-sm-12 well" id="content">
                        <h1>Welcome  <?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];?>!</h1>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 " id="content-1">
                            <div class="box">
                                <div class="info">
                                    <h4 class="text-center" id='stepT'>Select Courses</h4>
																		<!-- <table style="width:100%" class="table table-bordered">
																		  <tr>
																		    <th>Firstname</th>
																		    <th>Lastname</th>
																		    <th>Age</th>
																		  </tr>
																		  <tr>
																		    <td>Jill</td>
																		    <td>Smith</td>
																		    <td>50</td>
																		  </tr>
																		  <tr>
																		    <td>Eve</td>
																		    <td>Jackson</td>
																		    <td>94</td>
																		  </tr>
																		</table> -->
																		<?php
																		 echo '<table class="table table-bordered">

																		 <tr><td align="left"><b>Semester</b></td>
																		 <td align="left"><b>Type</b></td>
																		 <td align="left" colspan="2"><b>Course Code</b></td>
																		 <td align="left"><b>Name</b></td>
																		 <td align="left"><b>Stream</b></td>
																		 </tr>';
																		 while($row = mysqli_fetch_array($response)){
																			 echo '<tr><td align="left">'.$row['sem'].'</td>
																			 <td align="left">' .$row['type'] . '</td>
																			 <td align="left">'.$row['code_sub'] . '</td>
																			 <td align="left">'.$row['code_no'] . '</td>
																			 <td align="left">'.$row['name'] . '</td>
																			 <td align="left">'.$row['stream'] . '</td>';
																			 echo '</tr>';
																		 }

																		 echo '</table>';


																		//  foreach($open_elective as $item) {
																		// 		 echo $item, '<br>';
																		//  }
																		 //
																		//  foreach($core_elective as $item) {
																		// 		 echo $item, '<br>';
																		//  }

																		 mysqli_close($dbc);
																	 ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12  hide" id="content-2">
                            <div class="box">
                                <div class="info">
                                    <h4 class="text-center">Acadmic Policies</h4>
																		<?php
																				$policies = array("Academic_Progression.pdf","Disciplinary_Policy.pdf","SCHOLARSHIP_POLICY.pdf","Academic_Recovery_Policy.pdf","exam_guidelines.pdf");
																				foreach ($policies as $item) {
																					echo '<object class="col-xs-12" style="margin-bottom: 20px;" height = "400"data="policy_docs/'.$item.'"></object>';
																				}
																		 ?>

																		<form >
																			<p>
      																	<input type="checkbox"class="filled-in" onClick="EnableSubmit(this)" id="filled-in-box" />
      																	<label for="filled-in-box">Aceept</label>
    																	</p>
																		</form>
                                </div>
                            </div>
                        </div>
                        <input class="btn btn-lg btn-primary" type="button" value="Next" id="next" style="margin-left:20px;float:right;" />
                    </div>
                    <!-- <input type="button" value="Next" id="next" style="margin-left:20px;" /> -->
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <!-- /#wrapper -->
    <script lang="javascript">
        var list = document.getElementById('progress'),
            next = document.getElementById('next'),
            clear = document.getElementById('clear'),
            children = list.children,
            completed = 1;

        // simulate activating a node
        next.addEventListener('click', function() {

            // count the number of completed nodes.
            completed = (completed == 0.1) ? 1 : completed + 6;
						console.log(completed);
						//console.log(children.length);
						//console.log(completed >children.length);

             if (completed > children.length) {
							 flag = document.getElementById('this_is_not_how_you_do_it').value;
							 if (flag == 1) {
								 document.location = "final_new.php";
							 }else {
								 document.location = "final_old.php";
							 }}
						// /}return;

            // for each node that is completed, reflect the status
            // and show a green color
            for (var i = 1; i < completed; i++) {
                children[i].children[0].classList.remove('grey');
                children[i].children[0].classList.add('green');
            }
            // if this child is a node and not divider,
            // make it shine a little more
            if (i % 3 === 0) {
                children[i].children[0].classList.add('activated');
            }
            switch (completed) {
                case 7:
                    document.getElementById('stepT').innerHTML = "Step 2";
                    document.getElementById('content-1').setAttribute("class", "col-xs-12 hide");
                    document.getElementById('content-2').setAttribute("class", "col-xs-12");
										document.getElementById("next").disabled = true;
                    break;

            }

        }, false);


				EnableSubmit = function(val)
				{
				    var sbmt = document.getElementById("next");

				    if (val.checked == true)
				    {
				        sbmt.disabled = false;
				    }
				    else
				    {
				        sbmt.disabled = true;
				    }
				}
    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>
