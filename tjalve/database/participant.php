<?php
  class Participant {
    private $contactId;
    private $participantId;
    private $bib;
    private $firstName;
    private $lastName;
    private $birthYear;
    private $prio;
    private $disp_class = array(); //array med disciplines och klasser för tävlande
    private $competitionId;
    private $club;
    private $contactPerson;
    private $contactEmail;
    private $contactPhone;
       
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
    
    public function setClub($clubarg){
      $this->club = $clubarg;
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
      include "config.php";
  
      
      $sql = mysqli_query($con, "SELECT `contactId` FROM contact WHERE `phone` = '$this->contactPhone'");  //hämta kontaktID
      $contactId;
      
      while($row = $sql->fetch_object()){     //spara sålänge det finns att hämta
        $contactId = $row->contactId;
      }
      
      mysqli_close($con);
      
      return $contactId;
    }
    
    public function pushContacttoDB(){
      include "config.php";
      /*
      $sql = mysqli_query($con, "INSERT INTO `contact`(`competitionId`, `contactId`, `clubId`, `name`, `phone`, `email`)
              VALUES ('$this->competitionId', NULL, '1', '$this->contactPerson', '$this->contactEmail', '$this->contactPhone')");
      */
      /*if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));        ONÖDIGT
      }*/
      $sql = mysqli_query($con, "INSERT INTO `tjalve`.`contact` (`competitionId`, `contactId`, `clubId`, `name`, `phone`, `email`)
                                VALUES ('" . $this->competitionId . "', NULL, '1', 'Bosse', '14523', 'hej@hej.com')");
      
      mysqli_close($con);
      
      echo "hej";
      echo $this->competitionId;
    }

    
    public function pushParticipanttoDB(){
      include "config.php";
       
      $contactId = $this->getcontactId();
      
       
      $sql = mysqli_query($con, "INSERT INTO `participant`(`participantId`, `firstName`, `lastName`, `birthYear`, `contactId`)
              VALUES (NULL, '$this->firstName', '$this->lastName', '$this->birthYear', '$this->contactId')");
      
      mysqli_close($con);
    }
    
    }
  
?>