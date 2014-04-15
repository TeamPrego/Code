<?php 
include "participant.php";

$test = new Participant();
$test->setcompetitionId(1);
$test->setcontactPerson("Mr");
$test->setcontactEmail("Bronks");
$test->setcontactPhone("123");

$test->pushContacttoDB();

$test->setfirstName("Therese");
$test->setlastName("Rambol");
$test->setBirthYear(1990);

//$test->pushParticipanttoDB();

?>


