<?php 
include "../config.php";

$cId = $_GET['competitionId'];
$yearClass = $_GET['yearClass'];

$query = "SELECT * FROM competitiondisciplines WHERE competitionId = '$cId' AND yearClass = '$yearClass' ";
$data = mysqli_query($con, $query);

if (!$data) {
	  die('Error: ' . mysqli_error($con));
}

$array=[];
while($row = $data->fetch_object()) {
	array_push($array, $row->discipline);
	//$array = ['discipline'=> $row->yearClass];
}
echo json_encode($array);
?>