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
  
  class Contact {
    private $contactId;
    private $competitionId;
    private $club;
    private $clubId;
    private $contactPerson;
    private $contactEmail;
    private $contactPhone;
       
    public function __construct(){
    }

    // Gets the id of a club with a given name and then associates the contact with the clubId
    // Input: Clubarg (name of the club)
    public function setClub($clubarg){
      include "config.php";
      $this->club = $clubarg;

      $sql = mysqli_query($con, "SELECT clubId FROM clubs WHERE club = '$this->club'");  //hämta klubbID

      if (!$sql) {
        die('Error: ' . mysqli_error($con));
      } 
      while($row = $sql->fetch_object()){
        $this->clubId = $row->clubId;
      }
      mysqli_close($con);
    }
    
    //A bunch of set functions of class Contact are used along with a push-to-database function
    public function setcontactPerson($contact){
      $this->contactPerson = $contact;
    }
    
    public function setcontactEmail($email){
      $this->contactEmail = $email;
    }

    public function setcontactPhone($phone){
      $this->contactPhone = $phone;
    }
    
    public function setcompetitionId($id){
      $this->competitionId = $id;
    }
    
    public function getcontactId(){
        return $this->contactId;
    }
    
    // Adds a contact to the database with the acquired variables from the set functions of class contact
    public function pushContacttoDB(){
      include "config.php";
      
      $sql = mysqli_query($con, "INSERT INTO contact(competitionId, contactId, clubId, name, email, phone)
              VALUES ('$this->competitionId', NULL, '$this->clubId', '$this->contactPerson', '$this->contactEmail', '$this->contactPhone')");
      
      if (!$sql) {
        die('Error: ' . mysqli_error($con));
      }
      $this->contactId = $con->insert_id;
      mysqli_close($con);
    }
  }
  
  class ParticipantDisciplines {
    private $participantId;       //göra participantId global istället?
    private $yearClass=array();
    private $discipline=array();
    private $SB=array();
    private $PB=array();

    public function __construct(){
    }

    public function setParticipantId($Id){
      $this->participantId = $Id;
    }

    public function addYearClass($class){
      $this->yearClass[]=$class;
    }

    public function addDiscipline($disp){
      $this->discipline[]=$disp;
    }

    public function addSB($sb){
      $this->SB[]=$sb;
    }

    public function addPB($pb){
      $this->PB[]=$pb;
    }

    // A function to push information about which disciplines a participant is attending and their associated year classes.
    // Since one participant can attend more than one discipline and year class, the variables of these are stored in arrays using a for loop
    public function pushParticipantDisciplinestoDB(){
      include "config.php";
      for ($x=0; $x<=(sizeof($this->yearClass))-1; $x++){
        $sql = mysqli_query($con, "INSERT INTO participantdisciplines(participantId, pIndex, yearClass, discipline, SB, PB)
              VALUES ('$this->participantId', NULL, '$this->yearClass[$x]', '$this->discipline[$x]', '$this->SB[$x]', '$this->PB[$x]')");
      
        if (!$sql) {
          die('Error: ' . mysqli_error($con));
        }
      }
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
      $array[] = ['clubId' => $clubName,
                  'firstName' => $row->firstName,
                  'lastName' => $row->lastName,
                  'birthYear' => $row->birthYear,
                  'yearClass' => $row->yearClass,
                  'discipline' => $row->discipline];
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
      $disc[] = ['id' => $rowParticipant->participantId,
                 'fName' => $rowParticipant->firstName,
                 'lName' => $rowParticipant->lastName,
                 'discipline' =>  $rowParticipant->discipline,
                 'yearClass' =>  $rowParticipant->yearClass,
                 'bib' => $rowParticipant->bib,
                 'club' => $rowParticipant ->clubId,
                 'participantId' => $rowParticipant->participantId,
                 'prio' => $rowParticipant->prio,
                 'pIndex' => $rowParticipant->pIndex];
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
              INNER JOIN contact c ON p.contactId = c.contactId
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
                INNER JOIN contact c ON p.contactId = c.contactId
                INNER JOIN competition comp ON c.competitionId = comp.competitionId
                SET p.bib = '$startNumber'
                WHERE comp.competitionName = '$competitionName' AND p.participantId = '$participantId'";
      $update = mysqli_query($con, $query);
      $startNumber=$startNumber+1;
    }
  }
?>