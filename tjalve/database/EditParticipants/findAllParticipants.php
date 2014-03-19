<?php
	ob_start();
	include "database/config.php";
	//Ska skriva ut de anmälda till rätt tävling. måste kolla tävlings-id:t hos contact 
//innan det skrivs ut folk. Vad händer om det är ett glapp i  participantId?
	$query = "SELECT * FROM participant";
	//$query .= "SELECT * FROM disciplines";
	//$query .= "SELECT club FROM contact";
	$data = mysqli_query($con, $query);
	if (!$data) {
	  echo('poop');
	  die('Error: ' . mysqli_error($con));

	}
	//Lägg till competitionId
	//$clubQuery = "SELECT club FROM contact WHERE contactId = $participantData[contactId]"
	//$contactData = mysqli_query($con, $clubQuery);

	//MYSQLI_MULTI_QUERY!!!

	//if (!$contactData) {
	//  die('Error: ' . mysqli_error($con));
	//}
	$disabled = "disabled";
	echo ('hopp');
	while ($prow = $data->fetch_object()) {
		echo "<form method='POST' id='updateForm' name='updateForm' action='database/EditParticipants/updateParticipant.php?participantId=" . $prow->participantId . "'>" .
		"<tr> <td>" . 
		"<input class=resText id='u_fName' name='u_fName' type=text disabled value =" . $prow->firstName . "> </td> <td> " . 
		"<input class=resText id='u_fName' name='u_lName' type=text " . $disabled . " value =" . $prow->lastName . "> </td> <td>" . 
		"<input class=resText id='u_fName' name='u_bYear' type=text " . $disabled . " value =" . $prow->birthYear . "> </td> <td> " . 
		"<input class=resText id='u_fName' name='u_class' type=text " . $disabled . " value =" . $prow->class  . "> </td> <td> " . 
		"<input class=resText id='u_fName' name='u_discipin' type=text " . $disabled . " value =" . $prow->disciplin . "> </td> <td> " . 
		"<input class=resText id='u_fName' name='u_club' type=text " . $disabled . " value =" . $prow->class  . "> </td> <td> " . 
		//$prow->contactId->$contactData->fetch_object()->club . "</td> <td>" 
		"<input type='button' name='updateButton' id='updateButton' value='Uppdatera' onclick='updFunc()'> </td> <td>" .
		"<input type='submit' name='saveButton' id='saveButton' value='Spara' onclick='saveFunc()' disabled> </td> <td>" .
		"<a href='database/EditParticipants/deleteParticipantAdmin.php' class='confirmDelete'> <input type='button' name='deleteButt' id='deleteButt' value='Ta bort'  onclick='deleteFunc()'></a> </td> </tr> </form>";
	}

	mysqli_close($con);	
	ob_end_flush();
?>
echo ('tjipp');

<script type="text/javascript">
	function updFunc() {
 		document.getElementById('saveButton').disabled = "";
 		document.getElementById('updateButton').disabled = true;
 		document.getElementById('u_fName').disabled="";
	}
	function saveFunc() {
		document.getElementById('saveButton').disabled = true;
 		document.getElementById('updateButton').disabled = "";	
	}
	function deleteFunc() {
		//document.getElementById('deleteButt').confirm('Vill du ta bort deltagaren' document.getElementById('u_fName').value);
		//http://jsfiddle.net/vGc5P/1/
    }
</script>