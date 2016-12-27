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

echo '<table align="left"
cellspacing="5" cellpadding="8">

<tr><td align="left"><b>sem</b></td>
<td align="left"><b>type</b></td>
<td align="left"><b>code sub</b></td>
<td align="left"><b>code no</b></td>
<td align="left"><b>name</b></td>
<td align="left"><b>stream</b></td>
</tr>';
while($row = mysqli_fetch_array($response)){

	echo '<tr><td align="left">' .
$row['sem'] . '</td><td align="left">' .
$row['type'] . '</td><td align="left">'.
$row['code_sub'] . '</td><td align="left">'.
$row['code_no'] . '</td><td align="left">'.
$row['name'] . '</td><td align="left">'.
$row['stream'] . '</td><td align="left">';
echo '</tr>';



}


foreach($open_elective as $item) {
    echo $item, '<br>';
}

foreach($core_elective as $item) {
    echo $item, '<br>';
}

mysqli_close($dbc);
?>
