<?php
	ob_start();
	include_once "../class/contact.php";
	$temp = new Contact();
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