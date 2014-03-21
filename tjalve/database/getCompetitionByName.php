

<?php
	include "config.php";
	$competitionName = $_GET['competition'];
  //echo $competitionName;
	$dataCompetition = mysqli_query($con, "SELECT * FROM competition WHERE compName = '$competitionName'");
  //$dataCompetition = mysqli_query($con, "SELECT * FROM competition WHERE compName = 'Knarklyft'");
  //var_dump($dataCompetition);
	//echo "röv";
	$disc = [];
	while($row=$dataCompetition->fetch_object()) {
			$disc = ['compID' => $row->compID,
								 'compName' => $row->compName,
								 'compArr' => $row->compArr,
								 'compDate' => $row ->compDate,
								 'compLastDate' => $row->compLastDate,
                 ];
	}
  
  
  
  //echo compLastDate;
  
	mysqli_close($con);	
	echo json_encode($disc);
  
  
?>