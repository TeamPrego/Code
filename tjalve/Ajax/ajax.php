<?php 
	include "../class/competition.php";
	
	if(isset($_GET['compID'])){
		$temp =  new Competition();
		$temp->getAllAvailableDisciplines($_GET['compID']);
	}
	
	if(isset($_GET['compId']) && isset($_GET['gren']) && isset($_GET['klass'])){
		$temp =  new Competition();
		$temp->deleteDiscipline($_GET['compId'], $_GET['gren'], $_GET['klass']);
	}
	
	if(isset($_GET['competitionID']) && isset($_GET['inp'])) {

     $temp = new competition();
     $result = $temp->getAllDisciplines($_GET['competitionID'], $_GET['inp']);
	 echo json_encode($result);
}
?>