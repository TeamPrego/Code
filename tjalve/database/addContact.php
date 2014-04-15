<?php
	ob_start();
	include "participant.php";
	$temp = new Contact();
	//$compId = intval($_POST['competitionId']);
	//echo $compId;
	//echo gettype($compId);
	//$temp->setContact($compId, $_POST['chooseClub'],$_POST['contactPerson'],$_POST['contactEmail'],$_POST['contactPhone']);
	$temp->setcompetitionId(intval($_POST['competitionId']));
	$temp->setcontactPerson($_POST['contactPerson']);
	$temp->setcontactEmail($_POST['contactEmail']);
	$temp->setcontactPhone($_POST['contactPhone']);
	$temp->setClub($_POST['chooseClub']);
	$temp->pushContacttoDB();
	$contactId = $temp->getcontactId();

	mysqli_close($con);
	header("Location: ../applyTwo.php?contactId=".$contactId."&prio=".$_POST['prio']);
	ob_end_flush();
?>