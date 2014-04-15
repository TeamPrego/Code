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
    private $participantId;
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

    $array = [];
    while($row = $data->fetch_object()) {
      $array[] = ['clubId' => $clubId,
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
  // Output: An array with all participants
  function getAllParticipantFromCompetition($competitionName) {
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
      $disc[] = ['fName' => $rowParticipant->firstName,
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
?>