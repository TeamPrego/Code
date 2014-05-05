<?php 
include "participant.php";

include "contact.php";

$test = new Participant();
$test->setcontactPerson("hej");
$test->setcontactEmail("email");
$test->setcontactPhone("9993");
$test->setClub("Klubbilubbi");

$test->pushContacttoDB();

$test->setfirstName("Therese");
$test->setlastName("Rambol");
$test->setBirthYear(1990);

$test->pushParticipanttoDB();

?>