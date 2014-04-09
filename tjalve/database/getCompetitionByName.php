

<?php
	include "config.php";
	$competitionName = $_GET['competition'];
  //echo $competitionName;
	$dataCompetition = mysqli_query($con, "SELECT * FROM competition WHERE competitionName = '$competitionName'");
  //$dataCompetition = mysqli_query($con, "SELECT * FROM competition WHERE compName = 'Knarklyft'");
  //var_dump($dataCompetition);
	//echo "röv";
	$disc = [];
	while($row=$dataCompetition->fetch_object()) {
			$disc = ['compID' => $row->competitionId,
								 'compName' => $row->competitionName,
								 'compArr' => $row->organizer,
								 'compDate' => $row ->date,
								 'compLastDate' => $row->lastDate,
                 ];
	}
  
  //echo compLastDate;
  
	mysqli_close($con);	
	echo json_encode($disc);
  
  
?>