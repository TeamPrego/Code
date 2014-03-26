<?php
	include "config.php";
	$compID = $_GET['compID'];
	$inp	= $_GET['inp'];
	
	
	$query = "SELECT * FROM alldisciplines";
	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}
	
	$query2 = "SELECT discipline FROM age_class WHERE compId = '$compID' && ageClass = '$inp'";
	$data2 = mysqli_query($con, $query2);

	if (!$data2) {
	  die('Error: ' . mysqli_error($con));
	}
	
	$disc=[];
	while($row = $data->fetch_object()){
	$disc[] = ['gren'=>$row->discipline];
	}
	
	$compare=[];
	while($row = $data2->fetch_object()){
	$compare[] = ['gren'=>$row->discipline];
	}
	
	$compareTmp=[];
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
		$result=[];
		$result=array_diff($discTmp, $compareTmp);
		echo json_encode($result);
	
	
	mysqli_close($con);
	?>