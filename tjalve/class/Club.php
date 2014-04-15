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
	  public function setClub($theId, $theClub, $theAddress, $theZip, $thePhone, $theEmail) {
	  	$this -> id = $theId;
	  	$this -> club = $theClub;
	  	$this -> address = $theAddress;
	  	$this -> zip = $theZip;
	  	$this -> phone = $theZip;
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

	  // Get club from ClubId and return a Club-object
	  public function getClub($clubId) {
	  	include "config.php";
	  	$data = mysqli_query($con, "SELECT * FROM clubs WHERE clubId = '$clubId'");
	  	$row = $data->fetch_object();
			$club = new Club();
			$club->setClub($row->clubId, $row->club, $row->address, $row->zip, $row->phone, $row->email);
			return $club;
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
	}

