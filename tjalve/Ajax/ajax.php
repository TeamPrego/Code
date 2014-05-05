<?php 
	include_once "../class/competition.php";
	include_once "../class/Club.php";
  include_once "../class/event.php";
  include_once "../database/participant.php";


	if(isset($_GET['compID'])){
		$temp =  new Competition();
		$temp->getAllAvailableDisciplines($_GET['compID']);
	}

	
	if(isset($_GET['compId']) && isset($_GET['grenId']) && isset($_GET['klass'])){
		$temp =  new Competition();
		$temp->deleteDiscipline($_GET['compId'], $_GET['grenId'], $_GET['klass']);
	}
	
	if(isset($_GET['competitionID']) && isset($_GET['inp'])) {

     $temp = new competition();
     $result = $temp->getAllDisciplines($_GET['competitionID'], $_GET['inp']);
	 echo json_encode($result);
}

  
if(isset($_GET['compName'])) {
    //include "../class/competition.php";
    //include "event.php";
    $compName = $_GET['compName'];
    $temp = new competition();
    
    $result1 = $temp->getCompetitionByName($compName);
    
    $temp2 = new Event();
    $result2 = $temp2->getEventById($result1->id);
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

	// Gets all participant and their disciplines from one competition and returns JSON
	if(isset($_GET['getAllParticipantAndDesciplinesFromCompetition']) && isset($_GET['competitionName'])) {
		echo json_encode(getAllParticipantAndDesciplinesFromCompetition($_GET['competitionName']));
	}

	//Updates the bibnumbers on all participant in one competition.
	//Uses a startnumber and go throw all with an increasing number.
	if(isset($_GET['competitionName']) && isset($_GET['startNumber'])) {
		addRaceBibToAllParticipants($_GET['competitionName'], $_GET['startNumber']);
	}

// Gets all participant from one competition and returns JSON
	if(isset($_GET['getAllParticipantCompetition']) && isset($_GET['competitionName'])) {
		echo json_encode(getAllParticipantFromCompetition($_GET['competitionName']));
	}

	// Gets the Startlist for o competition - filerd by ageclass and discipline
	if(isset($_GET['competitionId']) && isset($_GET['ageClass'])  && isset($_GET['discipline'])) {
		echo json_encode(getStartlist($_GET['competitionId'], $_GET['ageClass'], $_GET['discipline']));
	}


//add event to database  
  if(isset($_GET['ID']) && isset($_GET['disciplines']) && isset($_GET['chosenClass'])){
    $class = $_GET['chosenClass'];
    $id = $_GET['ID'];
    $disciplines = $_GET['disciplines'];
    $discArray = explode(".", $disciplines);
    $event = new Event();
    
    $event->addEvents($id, $discArray, $class);
    
    /*$temp2 = new Event();
    $result2 = $temp2->getEventById($id);
    echo json_encode($result2);*/
  }
  
  //delete event from database  
  if(isset($_GET['deleteId']) && isset($_GET['deleteYearClass']) && isset($_GET['deleteDiscipline'])){
    $id = $_GET['deleteId'];
    $yearClass = $_GET['deleteYearClass'];
    $discipline = $_GET['deleteDiscipline'];
    $event = new Event();
    $event->deleteEvent($id, $discipline, $yearClass);
    
  }
  
  //update competition
  if(isset($_GET['updateId']) && isset($_GET['updateName']) && isset($_GET['updateDate']) && isset($_GET['updateLastDate']) && isset($_GET['updateOrganizer'])){
    $id = $_GET['updateId'];
    $name = $_GET['updateName'];
    $date = $_GET['updateDate'];
    $lastDate = $_GET['updateLastDate'];
    $organizer = $_GET['updateOrganizer'];
    $comp = new Competition();
    //$comp->updateCompetition($id, $name, $date, $lastDate, $organizer);
    $comp->updateCompetition($id, $name, $date, $lastDate, $organizer);
    
  }

?>