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
      $disciplineId = getDisciplineIdByCompetitionDisciplineId($discipline->competitionDisciplineId);
      $disicplineName = getDisciplineByDisciplineId($disciplineId);
      $yearClass = getYearClassByCompetitionDisciplineId($discipline->competitionDisciplineId);

      $array[] = ['pIndex'                        => $discipline->pIndex,
                  'competitionDisciplineId'       => $discipline->competitionDisciplineId,
                  'discipline'                    => $disicplineName,
                  'yearClass'                     => $yearClass,
                  'participantId'                 => $discipline->participantId,
                  'SB'                            => $discipline->SB,
                  'PB'                            => $discipline->PB,
                  'prio'                          => $discipline->prio];
    }
    return $array;
  }

  function getDisciplineByDisciplineId($disciplineId) {
    include "config.php";
    $query = "SELECT * FROM alldisciplines WHERE disciplineId = '$disciplineId'";
    $discipline = mysqli_query($con, $query);
    return $discipline->fetch_object()->discipline;
  }

  // Gets all disciplines in one yearclass in a competition
  // Input: yearClass and contactId
  // Output: An array with information
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
      $disciplineId = getDisciplineIdByCompetitionDisciplineId($row->competitionDisciplineId);
      $disicplineName = getDisciplineByDisciplineId($disciplineId);
      
      $disc[] = [ 'competitionDisciplineId'   => $row->competitionDisciplineId,
                  'discipline'                => $disicplineName,
                  'yearClass'                 => $row->yearClass];
    }
    mysqli_close($con);

    return $disc;
  }

  //Returns disciplineId from competitionDiscplineId
  function getDisciplineIdByCompetitionDisciplineId($competitionDisciplineId) {
    include "config.php";
    $data = mysqli_query($con, "SELECT disciplineId FROM competitiondisciplines WHERE competitionDisciplineId = '$competitionDisciplineId'");
    return $data->fetch_object()->disciplineId;
  }
    function getYearClassByCompetitionDisciplineId($competitionDisciplineId) {
    include "config.php";
    $data = mysqli_query($con, "SELECT yearClass FROM competitiondisciplines WHERE competitionDisciplineId = '$competitionDisciplineId'");
    return $data->fetch_object()->yearClass;
  }

  //Gets all disciplines for participant by participant id 
  //Input: Participant Id & Contact Id
  //Output: Array with pIndex, disciplines, year class, contact id
  function getDisciplinesByParticipantId($pId){
    include "config.php";
    $disciplinesquery = " SELECT pd.*, p.*, ad.*, cd.*
                          FROM alldisciplines ad
                          INNER JOIN competitiondisciplines cd  ON ad.disciplineId = cd.disciplineId
                          INNER JOIN participantdisciplines pd  ON cd.competitionDisciplineId = pd.competitionDisciplineId
                          INNER JOIN participant p              ON pd.participantId = p.participantId
                          WHERE p.participantId = '$pId'";
    $data = mysqli_query($con, $disciplinesquery);

    if (!$data) {
      die('Error: ' . mysqli_error($con));
    }

    $partDisciplines = [];
    while($discRow = $data->fetch_object()) {
      $partDisciplines[] = ['pIndex'     => $discRow->pIndex, 
                            'discipline' => $discRow->discipline, 
                            'ageClass'   => $discRow->yearClass,
                            'contactId'  => $discRow->contactId];
    }
    return $partDisciplines;
  }

  //Gets all disciplines of competition by competition id and year class
  //Input: Competition id and year class
  //Output: Array with discipline
  function getAllDisciplinesByCompId($cId, $yearClass){
    include "config.php";

    $cId = $_GET['competitionId'];
    $yearClass = $_GET['yearClass'];

    $query = "SELECT * FROM competitiondisciplines WHERE competitionId = '$cId' AND yearClass = '$yearClass' ";
    $data = mysqli_query($con, $query);

    if (!$data) {
        die('Error: ' . mysqli_error($con));
    }

    $array=array();
    while($row = $data->fetch_object()) {
      array_push($array, $row->discipline);
      //$array = ['discipline'=> $row->yearClass];
    }
    return $array;
  }
?>