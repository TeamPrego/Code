<?php 
	include "../class/competition.php";
	
	if(isset($_GET['compID'])) {
		$temp =  new Competition();
		$temp->getAllAvailableDisciplines($_GET['compID']);
	}

	//This will give all competitions from the DB
	if(isset($_GET['getAllCompetitions'])) {
		$comp = new Competition();
		echo json_encode($comp->getAllCompetitions());
	}
?>