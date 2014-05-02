<?php 
    
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
    // Input: Clubarg  (name of the club)
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
  
  ?>