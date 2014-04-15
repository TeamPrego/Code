<?php 
	include "class/competition.php";
	if(isset($_GET['compID'])){
		$temp =  new Competition();
		$temp->getAllAvailableDisciplines($_GET['compID']);
	}
?>