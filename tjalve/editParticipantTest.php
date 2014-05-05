<!--Granskad och godkänd 2014-03-04-->
<?php
session_start();
	include "templates/adminheader.php";
	include "class/participantTest.php";
?>	

<!-- Heading -->
<h1>Redigera anmälan</h1>
<!-- Line -->
<hr>

<h5 id="lefth5">Välj deltagare att redigera</h5>

<!-- Form -->
<div id="leftPartOfApplication">
	<!--Drop down list with all of the competition of the club-->
	<select id="getCompetitions">
		<?php
		$competition = getAllCompetitions(); 
		foreach ($competition as $theCompetition)
			echo "<option id='" .$theCompetition['competitionId']. "'>" .$theCompetition['competitionName']. "</option>";
		?>
	</select>
	
	<br>
	
	<select id="adminParticipants" size="20">
	<!-- All participants of chosen competition will appear here through ajax-->
	</select>
</div>

<!-- Chosen participant will appear to the right of the page -->
<div id="rightPartOfApplication">
	<h2>Redigera tävlande:</h2>
	<div id="confirmedDiv">
		<!-- Info about participant will appear here through ajax-->
	</div>
	
	<select id="classList">
		<!-- Classes will appear here -->
	</select>
	<div id="classDisciplines">
		<!-- Disciplines will appear here -->
	</div>
</div>


<script type="text/javascript">
	//Variable that is used when the Edit button is pressed
	var disabl = "disabled";
	//***** When competition drop down list is changed do: ******
	$('#getCompetitions').change(function() {
		//Get participants from the correct competition
		var competitionId = $(this).find("option:selected").attr('id');//This is competition id
		console.log(competitionId);
		$.ajax({
			url: 'Ajax/ajax.php?fetchParticipantsByCompId=1&competitionId='+competitionId,
			success: function(content) {
				content = $.parseJSON(content);
				var part_string = '';
				var substring = '';
				$.each(content, function(index, value) {
					if(index===0){
						part_string += '<option id="'+value.pId+'" selected="selected">'+value.pId+' - '+value.fName+' '+value.lName+'</option>';
						substring = value.pId + ' - ' + value.fName + ' ' + value.lName;
					}
					else {
						part_string += '<option id="'+value.pId+'">'+value.pId+' - '+value.fName+' '+value.lName+'</option>';
					}
				});
				document.getElementById('adminParticipants').innerHTML = part_string;
				$('#adminParticipants').val(substring);
				$('#adminParticipants').trigger("change");
			}
		});
		getYearClasses(competitionId);
	});
		
	// ***** Creating the drop down list with classes, this is used when adding new discipline to participant *****
	function getYearClasses(competitionId){
		$.ajax({
			url: 'Ajax/ajax.php?getYearClassesByCompId=1&competitionId='+competitionId,
			success: function(content){
				content = $.parseJSON(content);
				var competition_string = "";
				$.each(content, function(index,yearClass){
					competition_string += '<option id="'+yearClass+'"> '+yearClass+' </option>';
					substring = yearClass;
				});

				competition_string += '</select>'
				document.getElementById('classList').innerHTML = competition_string;
				$('#classList').val(substring);
				$('#classList').trigger("change");
			}
		});
	};

	//***** When participant is chosen from the list do: ******
	//Print all info about the participant
	$('#adminParticipants').change(function() {
		var participantId = $(this).find("option:selected").attr('id'); //This is the participant id
		console.log(participantId);
		var dat_string = "";
		var theClubId = "";
		var contactId = parseInt("");
		$.ajax({
			url: 'Ajax/ajax.php?fetchParticipantByParticipantId=1&participantId='+participantId,
			success: function(content) {
				content = $.parseJSON(content);
				$.each(content, function(index, value) {
					dat_string += '<div id="confirmedParticipantOneEach">'
					+ '<form method="POST" id="updateForm" name="updateForm" action="forms/updateParticipant.php?participantId='+participantId+'">'
					//+ '<input type="hidden" name="pId" value="'+participantId+'">'
					+ '<table id="participantTable">'
					+ '<tr><td><input class=update'+participantId+' name=fName type=text ' + disabl + ' value="' + value.firstName + '"></td>' 
					+ '<td><input class=update'+participantId+' name=lName type=text ' + disabl + ' value="' + value.lastName + '"></td></tr>'
					+ '<tr><td><input class=update'+participantId+' name=bYear type=text ' + disabl + ' value="' + value.birthYear + '"></td></tr>'
					+ '<tr><td> <div name="oneClub" class="showButton">' + value.club + '</div></td> <td></td> <td></td></tr>';
					theClubId = value.clubId;
					contactId = parseInt(value.contactId);
					contactId = parseInt('förnamn '+value.firstName);
				});
			}
		});

		//Create a drop down list for all the clubs available. 
		dat_string += '<tr><td><select name="clubsList" id = "clubsList" class="hideButton">';					
		$.ajax({
			url: 'Ajax/ajax.php/getAllClubs=1',
			success: function(club_content){
				club_content = $.parseJSON(club_content);

				$.each(club_content, function(theIndex, theValue) {
					if (theValue.clubId == theClubId) {
						//console.log(theValue.clubId);
						$("#clubsList").append('<option value="'+theValue.clubId+'" selected="selected">'+theValue.clubName+'</option>');
					}
					else {
						//console.log(theValue.clubId);
						$("#clubsList").append('<option value="'+theValue.clubId+'">'+theValue.clubName+'</option>');
					}
				});
				//Måste slänga med club id på den nya klubben till updateParticipant också... 
			}
		});

		//Gets all disciplines the participant has applied to 
		dat_string += '</select></td> <td></td> <td></td></tr>';
		$.ajax({
			url: 'Ajax/ajax.php?getDisciplinesByParticipantId=1&participantId='+participantId,
			success: function(discipline_content) {
				discipline_content = $.parseJSON(discipline_content);

				$.each(discipline_content, function(ind, val) {
					//console.log(val.pIndex);
					dat_string += '<tr><td>' + val.ageClass + '</td><td>' + val.discipline 
					+ '</td><td> <a href="database/EditParticipants/deleteParticipantClass.php?pIndex='+val.pIndex+'" > <button id="delButton">X</button> </a> </td></tr>';
				
					dat_string += '<tr><td><input type=button name="editButton" class="showButton" value="Redigera" onclick="enableFunc('+participantId+')"> '
					+ '<input type=submit name="saveButton" class="hideButton" value="Spara"> </td></tr>'
					+ '<tr><td>Lägg till grenar</td></tr>'
					+ '<input id="contactId" name="contactId" type=hidden value="' + val.contactId + '">';
					//console.log('kontaktid ' + val.contactId);
				});
				dat_string +='<tr><div id="disciplines"> </tr></table></form></div></div>';
			}
		});

	 	document.getElementById('confirmedDiv').innerHTML = dat_string;	
		//OM REDIGERA ÄR KLICKAD, GÖR ALLA FÄLT ENABLED, CLUB SKA BLI EN DROPDOWN,
		//OM LÄGG TILL KLASS ÄR KLICKAD, LÄGG IN DET SOM FINNS I APPLYTWO REDAN.
	});

	// ***** When class is chosen from drop down list, do: *****
	$('#classList').change(function(){
		//var competitionId = $(this).find("option:selected").attr('id');//This is competition id
		var yClass = $(this).find("option:selected").attr('id');
		var compId = $(getCompetitions).find("option:selected").attr('id');
		//var compId = document.getElementById("getCompetitions");
		console.log(yClass + ' och ' + compId);
		
		$.ajax({
			url: 'Ajax/ajax.php/getAllDisciplinesByCompId?yearClass='+yClass+'&competitionId='+compId,
			//url: 'database/EditParticipants/disciplines.php?yearClass='+yClass+'&competitionId='+compId,
			success: function(content){
				content = $.parseJSON(content);

				var disc_string = '<table id="whichDisciplines">';
				disc_string += '<tr><td></td> <th>Gren</th> <th>Åldersklass</th> <th>PB</th> <th>SB</th> </tr>';
				$.each(content, function(index, theDiscipline) {
					disc_string += 	'<tr><td><input type = "checkbox" name = "disciplineArray" value="'+theDiscipline+'"/></td><td>'
									 + theDiscipline
									 + '</td><td>'+yClass+'</td><td>'
									 + '<input type="text" name="PB'+theDiscipline+'" id="personBest"/></td>'
									 + '<td><input type="text" name="SB'+theDiscipline+'" id="seasonBest"/></td></tr>'
				});
				disc_string += '</table>';
				disc_string += '<input type="submit" name="addParticipator" id="addParticipator" value="Lägg till gren"/>';
							//+ '<?php include database/apply/disciplineList.php ?>';

				document.getElementById('classDisciplines').innerHTML = disc_string;
	 			$('#classDisciplines').trigger("change");
				}
			});
		});

	function enableFunc(idno) {
		var inputs = document.getElementsByClassName('update'+idno);
 		for(i=0; i<inputs.length; i++){
 			inputs[i].disabled = false;
 		}
 		document.getElementsByName("saveButton")[0].className="showButton";
 		

 		var editB = document.getElementsByName("editButton")[0];
 		editB.className="hideButton";
 		editB.setAttribute( "onClick", "javascript: saveFunc("+idno+");" );

 		document.getElementsByName("oneClub")[0].className="hideButton";
 		document.getElementsByName("clubsList")[0].className="showButton";
	}

	function saveFunc(idno) {
		var inputs = document.getElementsByClassName('update'+idno);
 		for(i=0; i<inputs.length; i++){
 			inputs[i].disabled = true;
 		}
 		document.getElementsByName("saveButton")[0].className="hideButton";
 		document.getElementsByName("oneClub")[0].className="showButton";
 		document.getElementsByName("clubsList")[0].className="hideButton";
 		
 		var editB = document.getElementsByName("editButton")[0];
		editB.className="showButton";
 		editB.setAttribute( "onClick", "javascript: enableFunc("+idno+");" );
	}

	function classesFunc() {
 		document.getElementsByName("classButton")[0].className="showButton";

	}
	
	 $('#getCompetitions').trigger("change");
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