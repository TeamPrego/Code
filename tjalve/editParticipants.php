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
	<!--Drop down list med alla tävlingar som finns i klubben-->
	<select id="getCompetitions">
		<?php
			include "database/config.php";
			$competitionQuery = "SELECT competitionName, competitionId FROM competition";
			$competitionData = mysqli_query($con, $competitionQuery);

			if (!$competitionData) {
			  die('Error: ' . mysqli_error($con));
			}

			while ($crow = $competitionData->fetch_object()) {
				++$compId;
				echo "<option id='" . $crow->competitionId . "'>" . $crow->competitionName . "</option>";
			}
			mysqli_close($con);
		?>
	</select>
	
	<br>
	
	<select id="adminParticipants" size="20">
	<!--Här slängs alla valbara deltagare in för rätt tävling-->
	</select>
</div>

<div id="rightPartOfApplication">
	<h2>Redigera tävlande:</h2>
	<div id="confirmedDiv">
		<!--Här kommer deltagaruppgifter in från ajaxtjossan-->
		<div id="disciplines">
			<!-- Här kommer tävlingsgrenar in från ajax -->
			<td><label for="select">Klass:</label></td>
			<td>
				<option> - Välj klass - </option>
				<?php
					include "database/EditParticipants/disciplines.php";
				?>
			</td>
		</div>
	</div>
</div>

<!-- ***** HÄMTAR ALLA DELTAGARE TILL VALD TÄVLING ***** -->
<script type="text/javascript">
	//När man ändrat val av tävling ska även deltagarlistan uppdateras:
	$('#getCompetitions').change(function() {
		//hämtar personer från rätt tävling
		var inp = $(this).find("option:selected").attr('id');
		console.log(inp);
		$.ajax({
			url: 'database/EditParticipants/fetchParticipantByCompId.php?competitionId='+inp+'',
			success: function(content) {
				content = $.parseJSON(content);
				var part_string = '';
				$.each(content, function(index, value) {
					if(index===0){
						part_string += '<option id="'+value.pId+'" selected="selected">'+value.pId+' - '+value.fName+' '+value.lName+'</option>';
					}
					else {
						part_string += '<option id="'+value.pId+'">'+value.pId+' - '+value.fName+' '+value.lName+'</option>';
					}
				});
				document.getElementById('adminParticipants').innerHTML = part_string;
			}
		});
	});


// ***** REDIGERA DELTAGAREN *****
	var disabl = "disabled";
	
	$('#adminParticipants').change(function() {
		var inp = $(this).find("option:selected").attr('id');
		console.log(inp);
		$.ajax({
			url: 'database/EditParticipants/fetchParticipantInfo.php?participantId='+inp+'',
			//Content är vad jag har echo:at från url:en
			success: function(content) {
				content = $.parseJSON(content);
				
				var dat_string = "";
				$.each(content, function(index, value) {
					dat_string += '<div id="confirmedParticipantOneEach">'
					+ '<form method="POST" id="updateForm" name="updateForm" action="database/EditParticipants/updateParticipant.php?participantId='+inp+'">'
					//+ '<input type="hidden" name="pId" value="'+inp+'">'
					+ '<table id="participantTable">'
					+ '<tr><td><input class=update'+inp+' name=fName type=text ' + disabl + ' value="' + value.firstName + '"></td>' 
					+ '<td><input class=update'+inp+' name=lName type=text ' + disabl + ' value="' + value.lastName + '"></td></tr>'
					+ '<tr><td><input class=update'+inp+' name=bYear type=text ' + disabl + ' value="' + value.birthYear + '"></td></tr>'
					+ '<tr><td> <div name="oneClub" class="showButton">' + value.club + '</div></td> <td></td> <td></td></tr>';
					
					var theClubId = value.clubId;

					dat_string += '<tr><td><select name="clubsList" id = "clubsList" class="hideButton">';
					dat_string += '<input type="hidden" name="newClubId" value="'+theClubId+'">';					
					$.ajax({
						url: 'database/EditParticipants/getAllClubs.php',
						success: function(club_content){
							club_content = $.parseJSON(club_content);

							$.each(club_content, function(theIndex, theValue) {
								if (theValue.clubId == theClubId)
									$("#clubsList").append('<option id="'+theValue.clubId+'" selected="selected">'+theValue.clubName+'</option>');
								else
									$("#clubsList").append('<option id="'+theValue.clubId+'">'+theValue.clubName+'</option>');
							});
							//Måste slänga med club id på den nya klubben till updateParticipant också... 
						}
					});

					dat_string += '</select></td> <td></td> <td></td></tr>';
					//***** Adding all applied classes & disciplines of this participant *****
					$.each(value.disciplines, function(ind, val) {
						//console.log(val.pIndex);
						dat_string += '<tr><td>' + val.ageClass + '</td><td>' + val.discipline 
						+ '</td><td> <a href="database/EditParticipants/deleteParticipantClass.php?pIndex='+val.pIndex+'" > <button id="delButton">X</button> </a> </td></tr>';
					});
					dat_string += '<tr><td><input type=button name="editButton" class="showButton" value="Redigera" onclick="enableFunc('+inp+')"> '
					+ '<input type=submit name="saveButton" class="hideButton" value="Spara"> </td></tr>'
					+ '<tr><td>Lägg till grenar</td></tr>'
					+ '<input id="contactId" name="contactId" type=hidden value="' + value.contactId + '">';
					
					dat_string += '<tr><div id="competitionDisciplines" name="competitionDisciplines">'
					+ '<select id="chooseClass"> ';
					$.each(value.allClasses, function(indx, valz) {
						$("#competitionDisciplines").append('<option id="'valz.yearClass'">'+valz.yearClass+'</option>');
					});

					</select></tr></table></form></div></div>'
					
				});
					
				document.getElementById('confirmedDiv').innerHTML = dat_string;	
			}
		});
	});

// ***** LÄGG TILL GRENAR *****
	$('#chooseClass').change(function() {
		var inp = $(this).find(":selected").text();
		var contactId = document.getElementById('contactId');	
		console.log(inp);
		$.ajax({
			url: 'getAvailableDisciplines.php?class='+inp+'&contactId='+contactId,
			success: function(content) {
				//console.log(content);
				content = $.parseJSON(content);
				var dat_string = '<table id="whichDisciplines">';
				dat_string += '<tr><td></td> <th>Gren</th> <th>Åldersklass</th> <th>PB</th> <th>SB</th> </tr>';
				$.each(content, function(index, value) {
					dat_string += 	'<tr><td><input type = "checkbox" name = "gren[]" value="'+value.gren+'"/></td><td>'
									 + value.gren
									 + '</td><td>'+inp+'</td><td>'
									 + '<input type="text" name="PB'+value.gren+'" id="personBest"/></td>'
									 + '<td><input type="text" name="SB'+value.gren+'" id="seasonBest"/></td></tr>'
				});
				dat_string += '</table>';
				dat_string += '<input type="submit" name="addParticipator" id="addParticipator" value="Lägg till deltagare"/></form>'
							+ '<?php include database/apply/disciplineList.php ?>';

				document.getElementById('disciplines').innerHTML = dat_string;
			}
		});
	});

// ***** FUNKTIONER *****
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

// ***** TRIGGERS *****
	$('#adminParticipants').trigger("change");
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