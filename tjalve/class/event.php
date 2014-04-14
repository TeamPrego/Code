<!--Filen ska representera en start/event med dennes åldersklass och gren-->
<?php 
  include "config.php";
  class Event {
    private $discipline;
    private $ageClass;
    
    public function __construct(){
    }
    
    public getEventById($id){
      include "config.php";
      $sql = "SELECT * FROM competitiondisciplines WHERE competitionId = '$id'";
      $dataEvent = mysqli_query($con, $sql);
      $data = [];
      while($row=$dataEvent->fetch_object()) {
                $data = ['competitionId' => $row->competitionId,
								'yearClass' => $row->yearClass,
                'discipline' => $row->discipline,
                ];
      }
      return $data;
      mysqli_close($con);	
    }
    
    public function getAllEvents(){
      include 'database/config.php';
      $sql = "SELECT * FROM competitiondisciplines WHERE 1";
      $dataEvent = mysqli_query($con, $sql);
      $allEvents = [];
      while($row=$dataEvent->fetch_object()) {
        $allEvents[] = ['id' => $row->competitionId, 
        'ageClass' => $row->yearClass, 
        'discipline' => $row->discipline,
        ];
        
      }
      mysqli_close($con);
      return $allEvents; 
    }
    
    public setDiscipline($newDiscipline){
      $this->discipline = $newDiscipline;
    }
    
    public setAgeClass($newAgeClass){
      $this->ageClass = $newAgeClass;
    }
  }
?>