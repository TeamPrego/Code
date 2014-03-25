
<?php
	include "config.php";
	$competitionID = $_GET['ID'];
  //echo $competitionName;
	//$dataCompetition = mysqli_query($con, "SELECT * FROM age_class WHERE compId = '$ID'");
  $dataCompetition = mysqli_query($con, "SELECT * FROM age_class WHERE compId = '$competitionID'");
  //echo $dataCompetition;
	$ageclass = [];
	while($row=$dataCompetition->fetch_object()) {
    $ageclass[] = ['ageC' => $row->ageClass,
    'disc' => $row->discipline
    ];
   
	}
  //echo $ageclass['disc'];
  //echo $ageclass[3];
	mysqli_close($con);	
	echo json_encode($ageclass);
  
  
?>