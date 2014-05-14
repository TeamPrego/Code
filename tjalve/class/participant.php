<?php
  class Participant {
    private $contactId;
    private $participantId;
    private $bib;
    private $firstName;
    private $lastName;
    private $birthYear;
       
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
    
    public function getParticipantsByEventId($eventId){
    include "config.php";
    $query = "SELECT * FROM participantdisciplines WHERE eventId = '$eventId'";
    $allParticipants = mysqli_query($con, $query);
    $array = [];
    
    while($participant = $allParticipants->fetch_object()){
      $array[] = ['participantId'     => $participant->participantId];
    }
    mysqli_close($con);
    return $array;
    }
    
    public function getParticipantById($id){
    include "config.php";
    $query = "SELECT * FROM participant WHERE participantId = '$id'";
    $allParticipants = mysqli_query($con, $query);
    $array = [];
    
    while($participant = $allParticipants->fetch_object()){
      $array[] = ['participantId' => $participant->participantId,
                  'firstName'     => $participant->firstName,
                  'lastName'      => $participant->lastName,
                  'birthYear'     => $participant->birthYear,
                  'bib'           => $participant->bib,
                  'prio'          => $participant->prio,
                  'contactId'     => $participant->contactId,
      ];
    }
    mysqli_close($con);
    return $array;
    }
    
  }

  // Gets all Participants from one club
  // Input: The clubid
  // Output: Array with participants
  function getAllParticipantsFromClub($clubId) {
    include "config.php";

    $query = "SELECT pd.*, p.*, ad.*, cd.*
              FROM alldisciplines ad
              INNER JOIN competitiondisciplines cd  ON ad.disciplineId = cd.disciplineId
              INNER JOIN participantdisciplines pd  ON cd.competitionDisciplineId = pd.competitionDisciplineId
              INNER JOIN participant p              ON pd.participantId = p.participantId
              INNER JOIN contact c                  ON p.contactId = c.contactId
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

    $query = "SELECT pd.*, p.*, c.*, ad.*, cd.*
              FROM alldisciplines ad
              INNER JOIN competitiondisciplines cd  ON ad.disciplineId = cd.disciplineId
              INNER JOIN participantdisciplines pd  ON cd.competitionDisciplineId = pd.competitionDisciplineId
              INNER JOIN participant p              ON pd.participantId = p.participantId
              INNER JOIN contact c                  ON p.contactId = c.contactId
              INNER JOIN competition comp           ON c.competitionId = comp.competitionId
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
                 'club'           => $rowParticipant ->clubId,
                 'participantId'  => $rowParticipant->participantId,
                 'prio'           => $rowParticipant->prio,
                 'pIndex'         => $rowParticipant->pIndex];
    }
    mysqli_close($con); 
    return $disc;
  }

  // Gets all Participants from one competition by the competition name
  // Input: Competition Name
  // Output: An array with all participants
  function getAllParticipantFromCompetition($competitionName) {
    include "config.php";
    $competitionName = $_GET['competitionName'];

    $query = "SELECT p.*, c.*
              FROM participant p
              INNER JOIN contact c          ON p.contactId = c.contactId
              INNER JOIN competition comp   ON c.competitionId = comp.competitionId
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
      $query = "UPDATE      participant p
                INNER JOIN  contact c         ON p.contactId = c.contactId
                INNER JOIN  competition comp  ON c.competitionId = comp.competitionId
                SET p.bib = '$startNumber'
                WHERE comp.competitionName = '$competitionName' AND p.participantId = '$participantId'";
      $update = mysqli_query($con, $query);
      $startNumber=$startNumber+1;
    }
  }

  function getAllParticipantsAndDisciplinesFromContactId($contactId) {
    include "config.php";
    $query = "SELECT * FROM participant WHERE contactId = '$contactId'";
    $allParticipants = mysqli_query($con, $query);

    $array = [];
    while($participant = $allParticipants->fetch_object()) {
      $array[] = ['firstName'     => $participant->firstName,
                  'lastName'      => $participant->lastName,
                  'contactId'     => $participant->contactId,
                  'birthYear'     => $participant->birthYear,
                  'bib'           => $participant->bib,
                  'participantId' => $participant->participantId,
                  'disciplines'   => getAllDisciplinesByParticipantId($participant->participantId)];
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
      $participantArray[] = [ 'pId'   => $prow->participantId, 
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

    $part[]  = ['firstName'  => $participant->firstName,
                'lastName'   => $participant->lastName,
                'birthYear'  => $participant->birthYear,
                'contactId'  => $participant->contactId,
                'club'       => $participant->club,
                'clubId'     => $participant->clubId];

    return $part;
  }
  
  
?>