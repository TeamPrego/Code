<?php
  class Competition {
    const $id;
    $name;
    $beginDate;
    $endDate;
    $lastDate;
    $arranger;
    
    public function __construct($compId, $compName, $compBegin, $compEnd, $compLast, $compArr){
      $id = $compId;
      $name = $compName;
      $beginDate = $compBegin;
      $endDate = $compEnd;
      $lastDate = $compLast;
      $arranger = $compArr;
    }
    
    public function changeName($newName) {
      $name=$newName;
    }
    public function changeBeginDate($newDate) {
      $beginDate=$newDate;
    }
    public function changeEndDate($newDate) {
      $endDate=$newDate;
    }
    public function changeLastDate($newDate) {
      $lastDate=$newDate;
    }
    public function changeArranger($newArranger) {
      $arranger=$newArranger;
    }
    
  }
?>