<?php 
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

  function getAllDisciplinesByParticipantId($participantId) {
    include "config.php";
    $query = "SELECT * FROM participantdisciplines WHERE participantId = '$participantId'";
    $allDisciplines = mysqli_query($con, $query);

    $array = [];
    while($discipline = $allDisciplines->fetch_object()) {
      $array[] = ['pIndex'          => $discipline->pIndex,
                  'discipline'      => $discipline->discipline,
                  'participantId'   => $discipline->participantId,
                  'yearClass'       => $discipline->yearClass,
                  'SB'              => $discipline->SB,
                  'PB'              => $discipline->PB,
                  'prio'            => $discipline->prio];
    }
    return $array;
  }

  function getDisciplineByDisciplineId($disciplineId) {
    include "config.php";
    $query = "SELECT * FROM alldisciplines WHERE disciplineId = '$disciplineId'";
    $discipline = mysqli_query($con, $query);
    return $discipline->fetch_object()->discipline;
  }

  function getAvalibleDisciplinesFromYearclassInCompetition($class,$contactId) {
    include "config.php";

    $data = mysqli_query($con, "SELECT competitionId FROM contact WHERE contactId = '$contactId'");
    $competitionid = $data->fetch_object()->competitionId;

    $query = "SELECT * FROM competitiondisciplines WHERE yearClass = '$class' AND competitionId = '$competitionid'";
    $data = mysqli_query($con, $query);

    if (!$data) {
      die('Error: ' . mysqli_error($con));
    }

    $disc = [];
    while($row = $data->fetch_object()) {
      $disc[] = [ 'gren' => getDisciplineByDisciplineId($row->disciplineId), 
                  'klass' => $row->yearClass];
    }
    mysqli_close($con);

    return $disc;
  }
?>