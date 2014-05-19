<?php
	include "config.php";
	$compID = $_GET['compID'];
	$inp	= $_GET['inp'];
	
	
	$query = "SELECT * FROM alldisciplines";
	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}
	
	$query2 = "SELECT discipline FROM competitiondisciplines WHERE competitionId = '$compID' && yearClass = '$inp'";
	$data2 = mysqli_query($con, $query2);

	if (!$data2) {
	  die('Error: ' . mysqli_error($con));
	}
	
	$disc=array();
	while($row = $data->fetch_object()){
	$disc[] = ['gren'=>$row->discipline];
	}
	
	$compare=array();
	while($row = $data2->fetch_object()){
	$compare[] = ['gren'=>$row->discipline];
	}
	
	$compareTmp=array();
		foreach($disc as $aV){
		$discTmp[] = $aV['gren'];
		}
		if(isset($compare)){
			foreach($compare as $aV){
				$compareTmp[] = $aV['gren'];
			}
		}
		else{
			$compareTmp[] = 'empty';
		}
		$result=array();
		$result=array_diff($discTmp, $compareTmp);
		echo json_encode($result);
	
	
	mysqli_close($con);
	?>