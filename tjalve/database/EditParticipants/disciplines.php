<?php 
$cId = $_POST['contactId'];

$getCompId = mysqli_query($con, "SELECT * FROM contact WHERE contactId = '$cId");
$competitionId = $getCompId->fetch_object()->competitionId;
$data = mysqli_query($con, "SELECT * FROM competitiondisciplines WHERE competitionId= '$competitionId'");
$array=[];
while($row = $data->fetch_object()) {
	if(!in_array($row->yearClass, $array)) {
		array_push($array, $row->yearClass);
		echo "<option value='" .$row->yearClass. "'>" .$row->yearClass. "</option>";
	}
}
?>