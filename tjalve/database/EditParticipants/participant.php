<?php
ob_start();
	include "../config.php";
	$participantId = $_GET['participantId'];

	class Participant {
		public $firstName, $lastName, $birthYear, $bib, $prio, $contactId;
		public $club; 
		public $allClubs, $allClubsData;

		public function fetchNameAndYear($participantId) {
			$query = "SELECT * FROM participant WHERE participantId = '$participantId'";
			$cData = mysqli_query($con, $query);

			if (!$cData) {
			  die('Error: ' . mysqli_error($con));
			}

			$participant = $cData->fetch_object();

			$contactId = $participant->contactId;
			$firstName = $participant->firstName;
			$lastName = $participant->lastName;
			$birthYear = $participant->birthYear;
		}

		public function fetchOneClub($contactId) {
			$clubquery = "SELECT clubId FROM contact WHERE contactId = '$contactId'";
			$clubData = mysqli_query($con, $clubquery);

			if (!$clubData) {
			  die('Error: ' . mysqli_error($con));
			}

			$club = $clubData->fetch_object()->clubId;
		}

		public function fetchAllClubs() {
			//Select all clubs
			$allClubs = "SELECT club FROM clubs";
			$allClubsData = mysqli_query($con, $allClubs);

			$clubsArray = [];
			while($clubRow = $allClubsData->fetch_object()) {
				$clubsArray[] = ['clubName' => $clubRow->Name];
			}
		}

		public function fetchParticipantDisciplines() {
			$part = [];
			$disciplinesquery = "SELECT * FROM participantdisciplines WHERE participantId = '$participantId'";
			$data = mysqli_query($con, $disciplinesquery);

			if (!$data) {
			  die('Error: ' . mysqli_error($con));
			}

			$discDisciplines = [];
			while($discRow = $data->fetch_object()) {
				$discDisciplines[] = ['pIndex' => $discRow->pIndex, 'discipline' => $discRow->discipline, 'ageClass' => $discRow->yearClass];
			}
			$part[] = [	'firstName' => $firstName,
						'lastName' => $lastName,
						'birthYear' => $birthYear,
						'club' => $club,
						'disciplines' => $discDisciplines, 
						'clubs' => $clubsArray];

			echo json_encode($part);
		}
	}



?>