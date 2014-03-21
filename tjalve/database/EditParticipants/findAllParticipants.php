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
	$idno = 0;
	$which = "odd";
	while ($prow = $data->fetch_object()) {
		++$idno;
		if ($idno%2==0)
			$which="even";
		else
			$which="odd";
		//Kollar om vilket radnummer för att ge raderna rätt färg
		echo "<form method='POST' id='updateForm' name='updateForm' action='database/EditParticipants/updateParticipant.php?participantId=" . $prow->participantId . "'>" .
		"<tr class='" . $which. "'> <td>" . 
		"<input class='u_fName".$idno."' name='u_fName' type=text disabled value =" . $prow->firstName . "> </td> <td> " . 
		"<input class='u_fName".$idno."' name='u_lName' type=text " . $disabled . " value =" . $prow->lastName . "> </td> <td>" . 
		"<input class='u_fName".$idno."' name='u_bYear' type=text " . $disabled . " value =" . $prow->birthYear . "> </td> <td> " . 
		"<input class='u_fName".$idno."' name='u_class' type=text " . $disabled . " value =" . $prow->class  . "> </td> <td> " . 
		"<input class='u_fName".$idno."' name='u_discipin' type=text " . $disabled . " value =" . $prow->discipline . "> </td> <td> " . 
		"<input class='u_fName".$idno."' name='u_club' type=text " . $disabled . " value =" . $prow->class  . "> </td> <td> " . 
		//$prow->contactId->$contactData->fetch_object()->club . "</td> <td>" 
		"<input type='button' id='updateButton" .$idno. "' name='updateButton' value='Uppdatera' onclick='updFunc($idno)' > </td> <td>" .
		"<input type='submit' id='saveButton" .$idno. "' name='saveButton' value='Spara' onclick='saveFunc()' disabled> </td> <td>" .
		"<a href='database/EditParticipants/deleteParticipantAdmin.php?participantId=" . $prow->participantId . "' class='confirmDelete'><input type='button' id='deleteButt" .$idno. "' name='deleteButt' value='Ta bort'  onclick='deleteFunc()'></a></td> </tr> </form>";
		//        database/EditParticipants/updateParticipant.php?participantId=83
	}

	mysqli_close($con);	
	ob_end_flush();
?>

<script type="text/javascript">
	function updFunc(idno) {
 		document.getElementById('saveButton'+idno).disabled = false;
 		document.getElementById('updateButton'+idno).disabled = true;
 		var inputs = document.getElementsByClassName('u_fName'+idno);
 		for(i=0; i<inputs.length; i++){
 			inputs[i].disabled = false;
 		}
	}
	function saveFunc(idno) {
		document.getElementById('saveButton'+idno).disabled = true;
 		document.getElementById('updateButton'+idno).disabled = false;
 		var inputs = document.getElementsByClassName('u_fName'+idno);
 		for(i=0; i<inputs.length; i++){
 			inputs[i].disabled = true;
 		}

	}
	function deleteFunc() {
		/*var el = document.getElementById('updateForm');
		el.addEventListener('submit', function(){
    		return confirm('Vill du ta bort deltagaren ' +document.getElementByName('u_fName'.value)+ 'från tävlingen?');
		}, false);*/
	//	console.log('Vill du ta bort deltagaren' document.getElementById('u_fName').value);
		//http://jsfiddle.net/vGc5P/1/
    }
</script>