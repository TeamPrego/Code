<!--Primary admin page-->
<!--Granskad och godkänd 2014-03-04-->
<?php
	include "templates/adminheader.php";
?>
<h1>Bestäm nummerlapp</h1>

<div id = "leftPartOfApplication">
	<h2>Nummerlappsinformation</h2>

	

	<?php
	include "database/config.php";

	$query = "SELECT * FROM participant";
	$data = mysqli_query($con, $query);
	
	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$count = 0;
	while($row = $data->fetch_object())
		$count +=1;

	echo "
	<table>
		<tr>
			<td>Välj tävling:</td> 
			<td> 
				<select name='chooseCompetition' id='chooseCompetition'>";
				include "database/config.php";
				$data = mysqli_query($con, 'SELECT * FROM competition');
				while($row = $data->fetch_object()) {
					echo "<option value='" .$row->compID. "'>" .$row->compName. "</option>";
				}					
				echo "
				</select>
			</td>
		</tr>
		<tr>
			<td>Antaltävlande:</td> 
			<td>".$count."</td>
		</tr>
		<tr>
			<td>Startnummer: </td>
			<td><input id='bibBegin' name='bibBegin' value='10'></input></td>
		</tr>
	</table>
	<input type='button' name='addParticipator' id='Update' value='Uppdatera'/>";
	?>
</div>

<div id = "rightPartOfApplication">
	<h2>Tävlingsdeltagare</h2>
	<div id="getParticipantBibDiv"></div>
</div>

<script type="text/javascript">



	$('#Update').click(function() {
		var competition =  $('#chooseCompetition').find(":selected").text();
		var startNumber = $('#bibBegin').val();
		$.ajax({
			url: 'database/addRaceBib.php?competition='+competition+'&startNumber='+startNumber+'',
			success: function(content){
				console.log("success");
				$('#chooseCompetition').trigger("change");
			}
		});
	});
	

	$('#chooseCompetition').change(function() {
		var inp = $(this).find(":selected").text();
		$.ajax({
			url: 'database/getAllParticipants.php?competitionName='+inp+'',
			success: function(content) {
				console.log(content);
				content = $.parseJSON(content);
				console.log(content);
				var dat_string = '<form method="POST" id="firstForm" name="firstForm" action="database/changeRaceBib.php">'
				dat_string += '<table class ="firstTableList">';
				dat_string += '<tr><th>Nummerlapp</th><th>Namn</th><th>Klubb</th>';
				$count = 0;
				$.each(content, function(index, value) {
					if($count % 2 === 0)
						$which = "even";
					else
						$which = "odd";

					dat_string += '<tr class="'+$which+'"><td><input name="'+value.participantId+'" value="'+value.bib+'" style="width: 30px">'
											+ '</input> </td><td>'+value.lName+', '+value.fName+'</td><td>'+value.club+'</td></tr>';
				});
				dat_string += '</table>';
				dat_string += '<input type="submit" id="changeBib" value="Uppdatera"/>';

				document.getElementById('getParticipantBibDiv').innerHTML = dat_string;
			}
		});
	});

	$('#chooseCompetition').trigger("change");

</script>

<div class=progressBar>
	0% klart
</div>

<?php
	include "templates/adminfooter.php";
?>