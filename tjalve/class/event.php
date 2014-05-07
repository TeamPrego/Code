
<?php 
  //include "config.php";
  
  class Event {
    
    public $id;
    public $discipline = "100 m";
    public $ageClass = "H22";
    public $eventId;
    
    
    public function __construct(){
    }
    
    //public function setEvent($eventId, $eventDisc, $eventAgeC){
    public function setEvent($competitionId, $eventAgeC, $eventDisc, $eventId){
      $this -> id = $competitionId;
      $this -> discipline = $eventDisc;
      $this -> ageClass = $eventAgeC;
      $this -> eventId  = $eventId;
    }
    
    public function getSingleEventById($eventId){
      include "config.php";
      $sql = "SELECT * FROM competitiondisciplines WHERE eventId =  2";
      $dataEvent = mysqli_query($con, $sql);
      $temp = new Event();
      $row = $dataEvent -> fetch_object();
      $temp -> setEvent($row->competitionId, $row->discipline, $row->yearClass, $row->eventId);
      
      mysqli_close($con);
      return $temp;
    }
    
    public function getEventById($id){
      include "config.php";
      $sql = "SELECT * FROM competitiondisciplines WHERE competitionId = '$id'";
      //$sql = "SELECT * FROM competitiondisciplines WHERE competitionId = 1";
      $dataEvent = mysqli_query($con, $sql);
      $data = [];
      while($row=$dataEvent->fetch_object()) {
                
                $data[] = ['competitionId' => $row->competitionId,
								'yearClass' => $row->yearClass,
                'discipline' => $row->discipline,
                'eventId' => $row->eventId,
                ];
      }
      mysqli_close($con);	
      return $data;
      
    }
    
    public function getAllEvents($id){
      include "config.php";
      $sql = "SELECT * FROM competitiondisciplines WHERE competitionId = '$id'";
      $dataEvent = mysqli_query($con, $sql);
      $allEvents = [];
      while($row=$dataEvent->fetch_object()) {
        $tempEvent = new Event();
        $tempEvent->setEvent($row->competitionId, $row->yearClass, $row->discipline, $row->eventId);
        $allEvents[] = $tempEvent;
        
      }
      mysqli_close($con);
      return $allEvents; 
    }
    
    public function addEvents($id, $disciplines, $ageClass){
      include "config.php";
      echo $disciplines;
      $sql = "INSERT INTO `competitiondisciplines` (`competitionId`, `yearClass`, `discipline`) VALUES ('$id', '$ageClass', '$disciplines[0]')";
      for ($i = 1; $i < count($disciplines)-1; $i++) {
        $sql .= ", ('$id','$ageClass','$disciplines[$i]')";
      }
      //$dataEvent = mysqli_query($con, $sql);
      if (!mysqli_query($con,$sql)) {
			  die('Error: ' . mysqli_error($con));
			}
      mysqli_close($con);
    }
    
    public function deleteEvent($id, $discipline, $ageClass){
      include "config.php";
      $sql = "DELETE FROM `competitiondisciplines` WHERE `competitionId`='$id' AND `yearClass`='$ageClass' AND `discipline`='$discipline'";
      if (!mysqli_query($con,$sql)) {
			  die('Error: ' . mysqli_error($con));
			}
      mysqli_close($con);
    }
    
    public function setDiscipline($newDiscipline){
      $this->discipline = $newDiscipline;
    }
    
    public function setAgeClass($newAgeClass){
      $this->ageClass = $newAgeClass;
    }
  }
?>