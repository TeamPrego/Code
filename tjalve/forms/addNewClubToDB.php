<?php
	include "../class/Club.php";
	$club = new Club();
	$club->setClub(0, $_POST['newClub'], $_POST['newClubNumber'],$_POST['newClubAdress'],$_POST['newClubZipAdress'],$_POST['newClubEmail']);
	$club->addClubToDB();
	header("Location: ../pagesUser/applyOne.php?competitionId=".$_GET['competitionId']."&prio=".$_GET['prio']);
?>