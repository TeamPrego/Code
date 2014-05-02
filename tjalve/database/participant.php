<?php
  class Participant {
    private $contactId;
    private $participantId;
    private $bib;
    private $firstName;
    private $lastName;
    private $birthYear;
    private $prio;
       
    public function __construct(){
    }
    
    //A bunch of set functions of class Participant are used along with a push-to-database function
    public function setfirstName($name){
      $this->firstName = $name;
    }
    
    public function setlastName($name){
      $this->lastName = $name;
    }

    public function setBirthYear($year){
      $this->birthYear = $year;
    }
    
    public function setPrio($nr){
      $this->prio = $nr;
    }

    public function setContactId($Id){
      $this->contactId = $Id;
    }
    
    public function getParticipantId(){
      return $this->participantId;
    }
    
    // Adds a participant to the database with the acquired variables from the set functions of class participant
    public function pushParticipanttoDB(){
      include "config.php";
       
      $sql = mysqli_query($con, "INSERT INTO participant(participantId, firstName, lastName, birthYear, contactId)
              VALUES (NULL, '$this->firstName', '$this->lastName', '$this->birthYear', '$this->contactId')");
              
      if (!$sql) {
        die('Error: ' . mysqli_error($con));
      }
      $this->participantId = $con->insert_id;

      mysqli_close($con);
    }
  }

  // Gets all Participants from one club
  // Input: The clubid
  // Output: Array with participants
  function getAllParticipantsFromClub($clubId) {
    include "config.php";

    $query = "SELECT pd.*, p.*
              FROM participantdisciplines pd
              INNER JOIN participant p ON pd.participantId = p.participantId
              INNER JOIN contact c ON p.contactId = c.contactId
              WHERE c.clubId = '$clubId'";
    
    $data = mysqli_query($con, $query);

    if (!$data) {
      die('Error: ' . mysqli_error($con));
    }
    $clubName = getClub($clubId)['club'];

    $array = [];
    while($row = $data->fetch_object()) {
      $array[] = ['clubId'      => $clubName,
                  'firstName'   => $row->firstName,
                  'lastName'    => $row->lastName,
                  'birthYear'   => $row->birthYear,
                  'yearClass'   => $row->yearClass,
                  'discipline'  => $row->discipline,
                  'cost'        => 50];
    }
    return($array);
  }
  
  // Gets all Participants from one competition by the competition name
  // Input: Competition Name
  // Output: An array with all participants and their desciplines
  function getAllParticipantAndDisciplinesFromCompetition($competitionName) {
    include "config.php";
    $competitionName = $_GET['competitionName'];

    $query = "SELECT pd.*, p.*, c.*
              FROM participantdisciplines pd
              INNER JOIN participant p ON pd.participantId = p.participantId
              INNER JOIN contact c ON p.contactId = c.contactId
              INNER JOIN competition comp ON c.competitionId = comp.competitionId
              WHERE comp.competitionName = '$competitionName'";

    $data = mysqli_query($con, $query);

    if (!$data) {
      die('Error: ' . mysqli_error($con));
    }

    $disc = [];
    while($rowParticipant = $data->fetch_object()) {
      $disc[] = ['id'             => $rowParticipant->participantId,
                 'fName'          => $rowParticipant->firstName,
                 'lName'          => $rowParticipant->lastName,
                 'discipline'     => $rowParticipant->discipline,
                 'yearClass'      => $rowParticipant->yearClass,
                 'bib'            => $rowParticipant->bib,
                 'club'           => $rowParticipant->clubId,
                 'participantId'  => $rowParticipant->participantId,
                 'prio'           => $rowParticipant->prio,
                 'pIndex'         => $rowParticipant->pIndex];
    }
    mysqli_close($con); 
    return $disc;
  }

  // Gets all Participants from one competition by the competition name
  // Input: Competition Name
  // Output: An array with all participants and their desciplines
  function getAllParticipantFromCompetition($competitionName) {
    include "config.php";
    $competitionName = $_GET['competitionName'];

    $query = "SELECT p.*, c.*
              FROM participant p
              INNER JOIN contact c        ON p.contactId = c.contactId
              INNER JOIN competition comp ON c.competitionId = comp.competitionId
              WHERE comp.competitionName = '$competitionName'";

    $data = mysqli_query($con, $query);

    if (!$data) {
      die('Error: ' . mysqli_error($con));
    }

    $disc = [];
    while($rowParticipant = $data->fetch_object()) {
      $clubName = getClub($rowParticipant->clubId)['club'];

      $disc[] = ['id'             => $rowParticipant->participantId,
                 'fName'          => $rowParticipant->firstName,
                 'lName'          => $rowParticipant->lastName,
                 'bib'            => $rowParticipant->bib,
                 'club'           => $clubName,
                 'participantId'  => $rowParticipant->participantId];
    }
    mysqli_close($con); 
    return $disc;
  }

  // Adds racebib to all participants in one competition.
  // Starts with the variable $startNumber and iterates throuth all participants
  function addRaceBibToAllParticipants($competitionName,$startNumber) {
    include "config.php";
    $allParticipants = getAllParticipantFromCompetition($competitionName);
    foreach ($allParticipants as $participant) {
      $participantId = $participant['participantId'];
      $query = "UPDATE participant p
                INNER JOIN contact c        ON p.contactId = c.contactId
                INNER JOIN competition comp ON c.competitionId = comp.competitionId
                SET p.bib = '$startNumber'
                WHERE comp.competitionName = '$competitionName' AND p.participantId = '$participantId'";
      $update = mysqli_query($con, $query);
      $startNumber=$startNumber+1;
    }
  }
?>