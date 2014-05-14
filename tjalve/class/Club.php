<?php
  class Club {
  
	  public $id;
	  public $club;
	  public $address;
	  public $zip;
	  public $phone;
	  public $email;
	  
	  // Empty contructor
		public function __construct() {
	  }

	  // Set a club
	  public function setClub($theId, $theClub, $thePhone, $theAddress, $theZip, $theEmail) {
	  	$this -> id = $theId;
	  	$this -> club = $theClub;
	  	$this -> address = $theAddress;
	  	$this -> zip = $theZip;
	  	$this -> phone = $thePhone;
	  	$this -> email = $theEmail;
	  }

	  // Add club to DB
	  public function addClubToDB() {
			include "config.php";
			$sql = "INSERT INTO clubs (club, phone, address, zip, email)
							VALUES ('$this->club','$this->phone','$this->address' ,'$this->zip' ,'$this->email')";

			if (!mysqli_query($con,$sql)) {
			  die('Error: ' . mysqli_error($con));
			}
			mysqli_close($con);
	  }

	  // Get all clubs, return an array with all Clubs available in the DB
	  public function getAllClubs() {
	  	include "config.php";
	  	$data = mysqli_query($con, "SELECT * FROM clubs");
	  	
	  	$allClubs = [];
	  	while($row = $data->fetch_object()) {
	  		$club = new Club();
	  		echo $row->club;
				$club->setClub($row->clubId, $row->club, $row->address, $row->zip, $row->phone, $row->email);
				$allClubs[] = $club;
	  	}
			return $allClubs;
	  }

	  // Gets all clubs from one competition[Input=competitionId, output=array with all clubs]
	  public function getAllClubsFromCompetition($competitionId) {
  		include "config.php";
			$query = "SELECT c.*
								FROM clubs c
								INNER JOIN contact co ON c.clubId = co.clubId
								WHERE co.competitionId = '$competitionId'";

			$data = mysqli_query($con, $query);

			if (!$data) {
			  die('Error: ' . mysqli_error($con));
			}

			$array = [];
			while($row = $data->fetch_object()) {
				$array[] = ['clubId' 	=> $row->clubId,
										'club' 		=> $row->club,
										'address' => $row->address,
										'zip' 		=> $row->zip,
										'phone' 	=> $row->phone,
										'email' 	=> $row->email];
			}
			return $array;
	  }
	}
	
	// Get club from ClubId and return a Club-object
	function getClub($clubId) {
		include "config.php";
		$data = mysqli_query($con, "SELECT * FROM clubs WHERE clubId = '$clubId'");
		$row = $data->fetch_object();
		$club = [	'clubId' 	=> $row->clubId,
							'club' 		=> $row->club,
							'address' => $row->address,
							'zip' 		=> $row->zip,
							'phone' 	=> $row->phone,
							'email' 	=> $row->email];
		return $club;
	}

	//Gets all clubs
	//Input: 
	//Output: Array with club name and club id
	function getAllClubs(){
		include "config.php";

		$query = "SELECT * FROM clubs";
		$data = mysqli_query($con, $query);

		if (!$data) {
		  die('Error: ' . mysqli_error($con));
		}

		$allClubs = [];
		while($clubInfo = $data->fetch_object()) {
			$allClubs[] = [	'clubName' 	=> $clubInfo->club, 
											'clubId' 		=> $clubInfo->clubId];
		}
		
		return $allClubs;
	}
?>

