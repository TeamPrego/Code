<!--Filen ska representera en start/event med dennes åldersklass och gren-->
<?php 
  include "config.php";
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
    
   /* public function getEventById($id){
      include "config.php";
      //$sql = "SELECT * FROM competitiondisciplines WHERE competitionId = '$id'";
      $sql = "SELECT * FROM competitiondisciplines WHERE competitionId = 1";
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
      
    }*/
    
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
    
    public function setDiscipline($newDiscipline){
      $this->discipline = $newDiscipline;
    }
    
    public function setAgeClass($newAgeClass){
      $this->ageClass = $newAgeClass;
    }
  }
?>