<!--Granskad och godkänd 2014-03-04-->
<?php
session_start();
	include "templates/adminheader.php";
?>	

<!--Headning -->
<h1>Redigera anmälan</h1>
<!--Line -->
<hr>

<h5 id="lefth5">Välj deltagare att redigera</h5>

<!--The Form Part Two -->
<div id="leftPartOfApplication">
	
		<select id="adminParticipants" size="20">
			<?php
				//Fetching and printing all the participants
				include "database/config.php";
				$query = "SELECT * FROM participant";
				$data = mysqli_query($con, $query);
				if (!$data) {
				  die('Error: ' . mysqli_error($con));
				}
				while ($prow = $data->fetch_object()) {
					++$idno;
					echo "<option id='" . $prow->participantId . "'>" . $prow->participantId . " - " . $prow->firstName . " " . $prow->lastName . "</option>";
				}
				mysqli_close($con);
			?>
		</select>
</div>

<div id="rightPartOfApplication">
	<h2>Redigera tävlande:</h2>
	<div id="confirmedDiv">
		<!--Här kommer allt in från ajaxtjossan-->
	</div>
</div>


<script type="text/javascript">
	var disabl = "disabled";
	$('#adminParticipants').change(function() {
		var inp = $(this).find("option:selected").attr('id');
		console.log(inp);
		$.ajax({
			url: 'database/EditParticipants/fetchParticipantInfo.php?participantId='+inp+'',
			//Content är vad jag har echo:at från url:en
			success: function(content) {
				content = $.parseJSON(content);
				//console.log(content);
				
				var dat_string = "";
				$.each(content, function(index, value) {
					dat_string += '<div id="confirmedParticipantOneEach">'
					+ '<form method="POST" id="updateForm" name="updateForm" action="database/EditParticipants/updateParticipant.php?participantId='+inp+'">'
					//+ '<input type="hidden" name="pId" value="'+inp+'">'
					+ '<table id="participantTable">'
					+ '<tr><td><input class=update'+inp+' name=fName type=text ' + disabl + ' value="' + value.firstName + '"></td>' 
					+ '<td><input class=update'+inp+' name=lName type=text ' + disabl + ' value="' + value.lastName + '"></td></tr>'
					+ '<tr><td><input class=update'+inp+' name=bYear type=text ' + disabl + ' value="' + value.birthYear + '"></td></tr>'
					+ '<tr><td>' + value.club + '</td> <td></td> <td></td></tr>';
					$.each(value.disciplines, function(ind, val) {
						console.log(val.pIndex);
						dat_string += '<tr><td>' + val.ageClass + '</td><td>' + val.discipline 
						+ '</td><td> <a href="database/EditParticipants/deleteParticipantClass.php?pIndex='+val.pIndex+'" > <button id="delButton">X</button> </a> </td></tr>';
					});
					dat_string += '<tr><td><input type=button name="editButton" id="showButton" value="Redigera" onclick="enableFunc('+inp+')"> '
					+ '<input type=submit name="saveButton" id="hideButton" value="Spara"> </td>'
					+ '<td><a href=""><input type=button id="addButton" value="Lägg till grenar"></td></tr></table></form></div>';
				});		
			document.getElementById('confirmedDiv').innerHTML = dat_string;	
			}
		});
		//OM REDIGERA ÄR KLICKAD, GÖR ALLA FÄLT ENABLED, CLUB SKA BLI EN DROPDOWN,
		//OM LÄGG TILL KLASS ÄR KLICKAD, LÄGG IN DET SOM FINNS I APPLYTWO REDAN.

	});

	function enableFunc(idno) {
		var inputs = document.getElementsByClassName('update'+idno);
 		for(i=0; i<inputs.length; i++){
 			inputs[i].disabled = false;
 		}
 		document.getElementsByName("saveButton")[0].id="showButton";

 		var editB = document.getElementsByName("editButton")[0];
 		editB.id="hideButton";
 		editB.setAttribute( "onClick", "javascript: saveFunc("+idno+");" );
	}

	function saveFunc(idno) {
		var inputs = document.getElementsByClassName('update'+idno);
 		for(i=0; i<inputs.length; i++){
 			inputs[i].disabled = true;
 		}
 		document.getElementsByName("saveButton")[0].id="hideButton";

 		var editB = document.getElementsByName("editButton")[0];
		editB.id="showButton";
 		editB.setAttribute( "onClick", "javascript: enableFunc("+idno+");" );
	}
</script>
<?php

?>
<!--The Progress Bar -->
<div class=progressBar>
	<div class=progress>50% klart</div>
</div

	
<?php
	include "templates/adminfooter.php";
?>