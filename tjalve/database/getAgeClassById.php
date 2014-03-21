
<?php
	include "config.php";
	//$competitionID = $_GET['ID'];
  //echo $competitionName;
	//$dataCompetition = mysqli_query($con, "SELECT * FROM age_class WHERE compId = '$ID'");
  $dataCompetition = mysqli_query($con, "SELECT * FROM age_class WHERE compId = 2");
  //echo $dataCompetition;
	$ageclass = [];
	while($row=$dataCompetition->fetch_object()) {
    echo $row->ageClass;
			$ageclass = ['ageC' => $row->ageClass,'disc' => $row->discipline];
	}
  
	mysqli_close($con);	
	echo json_encode($ageclass);
  
  
?>