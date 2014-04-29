<?php 
include "../config.php";

$cId = $_GET['competitionId'];

$query = "SELECT * FROM competitiondisciplines WHERE competitionId = '$cId'";
$data = mysqli_query($con, $query);

if (!$data) {
	  die('Error: ' . mysqli_error($con));
}

$array=[];
while($row = $data->fetch_object()) {
	if (!in_array($row->yearClass, $array)){
			array_push($array, $row->yearClass);
	}
}
echo json_encode($array);
?>