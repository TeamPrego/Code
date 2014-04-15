<?php 
	include_once "../class/competition.php";
	include_once "../class/Club.php";
  include_once "../class/event.php";
  include_once "../database/participant.php";

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

	// Gets all clubs from one competition and returns JSON
	if(isset($_GET['getAllClubsFromCompetition']) && isset($_GET['competitionId'])) {
		$clubs = new Club();
		echo json_encode($clubs->getAllClubsFromCompetition($_GET['competitionId']));
	}

	// Gets all participant from one club and returns JSON
	if(isset($_GET['getAllParticipantFromClub']) && isset($_GET['clubId'])) {
		echo json_encode(getAllParticipantsFromClub($_GET['clubId']));
	}

	// Gets all participant from one competition and returns JSON
	if(isset($_GET['getAllParticipantFromCompetition']) && isset($_GET['competitionName'])) {
		echo json_encode(getAllParticipantFromCompetition($_GET['competitionName']));
	}
?>