<?php 
	include_once "../class/competition.php";
  include_once "../class/event.php";

	if(isset($_GET['compID'])){
		$temp =  new Competition();
		$temp->getAllAvailableDisciplines($_GET['compID']);
	}
  
 if(isset($_GET['compName'])) {
    //include "../class/competition.php";
    //include "event.php";
    $compName = $_GET['compName'];
    $temp = new competition();
    
    $result1 = $temp->getCompetitionByName($compName);
    
    //$temp2 = new Event();
    $result2 = $temp->getEventById($result1->id);
    $resultTot = array($result1, $result2);
    //$resultTot = array($result1);
    //$resultTot[] = ("foo", "spliff"); 
    //echo json_encode($resultTot);
    echo json_encode($resultTot);
	}

	//This will give all competitions from the DB
	if(isset($_GET['getAllCompetitions'])) {
		$comp = new Competition();
		echo json_encode($comp->getAllCompetitions());
	}
?>