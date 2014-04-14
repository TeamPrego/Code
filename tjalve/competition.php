<?php
  include 'database/config.php';
  class Competition {
    public $id;
    public $name;
    public $beginDate;
    //private $endDate;
    public $lastDate;
    public $arranger;
    
    public function __construct(){
    }
    
    /*public function __construct($compName, $compBegin, $compLast, $compArr, $logo){
      include 'database/config.php';
      $name = $compName;
      $beginDate = $compBegin;
      //$endDate = $compEnd;
      $lastDate = $compLast;
      $arranger = $compArr;
      $sql = "INSERT INTO `competition` (`competitionId`, `competitionName`, `date`, `lastDate`, 'organizer', 'logo') 
      VALUES (NULL,'$name','$beginDate','$lastDate','$arranger', '$logo')";
      if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
      }
      mysqli_close($con);
    }*/
    
    public function changeName($newName) {
      $name=$newName;
      $sql = "UPDATE `competition` SET `competitionName` = '$name' WHERE `competition`.`competitionId` = '$id'";
      if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
      }
      mysqli_close($con);
    }
    
    public function changeBeginDate($newDate) {
      $beginDate=$newDate;
      $sql = "UPDATE `competition` SET `date` = '$beginDate' WHERE `competition`.`competitionId` = '$id'";
      if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
      }
      mysqli_close($con);
    }
    
    /*public function changeEndDate($newDate) {
      $endDate=$newDate;
      $name=$newName;
      $sql = "UPDATE `competition` SET `last` = '$name' WHERE `competition`.`competitionId` = '$id'";
      if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
      }
      mysqli_close($con);
    }*/
    
    public function changeLastDate($newDate) {
      $lastDate=$newDate;
      $sql = "UPDATE `competition` SET `lastDate` = '$lastDate' WHERE `competition`.`competitionId` = '$id'";
      if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
      }
      mysqli_close($con);
    }
    
    public function changeArranger($newArranger) {
      $arranger=$newArranger;
      $sql = "UPDATE `competition` SET `organizer` = '$arranger' WHERE `competition`.`competitionId` = '$id'";
      if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
      }
      mysqli_close($con);
    }
    
    public function getCompetitionByName($compName){
      
      include "database/config.php";
      $sql = "SELECT * FROM competition WHERE competitionName = '$compName'";
      $dataCompetition = mysqli_query($con, $sql);
      while($row=$dataCompetition->fetch_object()) {
                $this->id = $row->competitionId;
								$this->name =  $row->competitionName;
                //echo $name;
								$this->arranger =  $row->organizer;
								$this->beginDate = $row ->date;
								$this->lastDate = $row->lastDate;
      }
      //echo "yao boah";
      mysqli_close($con);	
    }
    
    public function getCompetitionById($compId){
      include 'database/config.php';
      $sql = "SELECT * FROM competition WHERE competitionId = '$compId'";
      $dataCompetition = mysqli_query($con, $sql);
      
      while($row=$dataCompetition->fetch_object()) {
                $id = $row->competitionId;
								$name =  $row->competitionName;
								$arranger =  $row->organizer;
								$beginDate = $row ->date;
								$lastDate = $row->lastDate;
      }
      mysqli_close($con);	
      
    }
    /*
      Function below should return an array with competition objects, 
      the array can then be used for exemple for outputting names of
      the competitions.
    */
    public function getAllCompetitions(){
      include 'database/config.php';
      $sql = "SELECT * FROM competition WHERE 1";
      $dataCompetition = mysqli_query($con, $sql);
      $allCompetitions = [];
      while($row=$dataCompetition->fetch_object()) {
        $allCompetitions[] = ['id' => $row->competitionId, 'name' => $row->competitionName, 'arranger' => $row->organizer, 'beginDate' => $row->date, 'lastDate' => $row->lastDate];
        //echo $allCompetitions[0]->name;
      }
      mysqli_close($con);
      return $allCompetitions; 
    }
    
  }
?>