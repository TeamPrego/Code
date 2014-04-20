
<?php 
  //include "config.php";
  
  class Event {
    
    public $id;
    public $discipline;
    public $ageClass;
    
    public function __construct(){
    }
    
    public function setEvent($eventDisc, $eventAgeC){
      $this->discipline = $eventDisc;
      $this->ageClass = $eventAgeC;
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
        $tempEvent->setEvent($row->competitionId, $row->yearClass, $row->discipline);
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
      $dataEvent = mysqli_query($con, $sql);
      mysqli_close($con);
      return 0;
    }
    
    public function setDiscipline($newDiscipline){
      $this->discipline = $newDiscipline;
    }
    
    public function setAgeClass($newAgeClass){
      $this->ageClass = $newAgeClass;
    }
  }
?>