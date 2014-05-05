<?php

include "participant.php";

	$temp2 = new ParticipantDisciplines();
	$temp2->setParticipantId(29);
	$temp2->addYearClass('P11');
	$temp2->addDiscipline('60m');
	$temp2->addSB('53');
	$temp2->addPB('63');
	$temp2->pushParticipantDisciplinestoDB();

?>