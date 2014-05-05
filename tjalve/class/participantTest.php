<?php
// ob_start();
// 	include "config.php";
// 	$participantId = $_GET['participantId'];

// 	class Participant {
// 		public $firstName, $lastName, $birthYear, $bib, $prio, $contactId;
// 		public $club; 
// 		public $allClubs, $allClubsData;

// 		public function __construct() {
// 		}
// 	}
	
	//Gets all competition
	//Input: 
	//Output: Array with all competitions
	function getAllCompetitions() {
		include "config.php";
		$competitionQuery = "SELECT competitionName, competitionId FROM competition";
		$competitionData = mysqli_query($con, $competitionQuery);

		if (!$competitionData) {
		  die('Error: ' . mysqli_error($con));
		}

		$competitionArray = [];
		while ($crow = $competitionData->fetch_object()) {
			$competitionArray[] =  ['competitionId' => $crow->competitionId, 
														'competitionName' => $crow->competitionName];
		}
		mysqli_close($con);
		return $competitionArray;
	}

	//Gets all classes for competition with competition id
	//Input: Competition Id
	//Output: Array with all year classes
	function getYearClassesByCompId($cId){
		include "config.php";

		$query = "SELECT * FROM competitiondisciplines WHERE competitionId = '$cId'";
		$data = mysqli_query($con, $query);

		if (!$data) {
			  die('Error: ' . mysqli_error($con));
		}

		$array=[];
		while($row = $data->fetch_object()) {
			if (!in_array($row->yearClass, $array)){
					array_push($array, $row->yearClass);
			}
		}
		return $array;
	}

	//Gets all participant for competition with competition id
	//Input: Competition Id
	//Output: Array with participants id, first name and last name
	function fetchParticipantsByCompId($cId){
		include "config.php";
		$query = "SELECT p.participantId, p.firstName, p.lastName, c.competitionId
							FROM participant p
							INNER JOIN contact co ON p.contactId = co.contactId
							INNER JOIN competition c ON c.competitionId = co.competitionId
							WHERE c.competitionId = '$cId'";

		$data = mysqli_query($con, $query);

		if (!$data) {
		  die('Error: ' . mysqli_error($con));
		}

		$participantArray = [];
		while($prow = $data->fetch_object()) {
			$participantArray[] = [	'pId'		=> $prow->participantId, 
															'fName' => $prow->firstName, 
															'lName' => $prow->lastName];
		}
		return $participantArray;
	}

	//Gets all info about chosen participant
	//Input: Participant Id
	//Output: Array with first name, last name, birth date, club, disciplines, klubb, contact id and all classes and disciplines of competition 
	function fetchParticipantByParticipantId($pId){
		include "config.php";

		//***** Get everything about participant *****
		$query = "SELECT p.*, cl.club, cl.clubId
							FROM participant p
							INNER JOIN contact c ON p.contactId = c.contactId
							INNER JOIN clubs cl ON cl.clubId = c.clubId
							WHERE p.participantId = '$pId'";
		$cData = mysqli_query($con, $query);

		if (!$cData) {
		  die('Error: ' . mysqli_error($con));
		}
		$participant = $cData->fetch_object();

		$part[]	 = ['firstName'  => $participant->firstName,
						 		'lastName'   => $participant->lastName,
						 		'birthYear'  => $participant->birthYear,
			 				  'contactId'  => $participant->contactId,
							  'club'			 => $participant->club,
							  'clubId'		 => $participant->clubId];

		return $part;
	}

	//Gets all disciplines for participant by participant id 
	//Input: Participant Id & Contact Id
	//Output: Array with pIndex, disciplines, year class, contact id
	function getDisciplinesByParticipantId($pId){
		include "config.php";
		$disciplinesquery = "SELECT pd.*, p.contactId
												 FROM participantdisciplines pd
												 INNER JOIN participant p ON pd.participantId = p.participantId
												 WHERE p.participantId = '$pId'";
		$data = mysqli_query($con, $disciplinesquery);

		if (!$data) {
		  die('Error: ' . mysqli_error($con));
		}

		$partDisciplines = [];
		while($discRow = $data->fetch_object()) {
			$partDisciplines[] = ['pIndex'		 => $discRow->pIndex, 
														'discipline' => $discRow->discipline, 
														'ageClass'	 => $discRow->yearClass,
														'contactId'  => $discRow->contactId];
		}
		return $partDisciplines;
	}

	//Gets all clubs
	//Input: 
	//Output: Array with club name and club id
	function getAllClubs(){
		include "config.php";

		$query = "SELECT club, clubId FROM clubs";
		$data = mysqli_query($con, $query);

		if (!$data) {
		  die('Error: ' . mysqli_error($con));
		}

		$allClubs = [];
		while($clubInfo = $data->fetch_object()) {
			$allClubs[] = ['clubName' => $clubInfo->club, 'clubId' => $clubInfo->clubId];
		}
		
		return $allClubs;
	}

	//Gets all disciplines of competition by competition id and year class
	//Input: Competition id and year class
	//Output: Array with discipline
	function getAllDisciplinesByCompId($cId, $yearClass){
		include "config.php";

		$cId = $_GET['competitionId'];
		$yearClass = $_GET['yearClass'];

		$query = "SELECT * FROM competitiondisciplines WHERE competitionId = '$cId' AND yearClass = '$yearClass' ";
		$data = mysqli_query($con, $query);

		if (!$data) {
			  die('Error: ' . mysqli_error($con));
		}

		$array=[];
		while($row = $data->fetch_object()) {
			array_push($array, $row->discipline);
			//$array = ['discipline'=> $row->yearClass];
		}
		return $array;
	}

?>