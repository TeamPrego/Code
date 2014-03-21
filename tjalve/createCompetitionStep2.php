<!--Create competition page-->
<!--Granskad och godkänd 2014-03-04-->

<?php
include "templates/adminheader.php";
?>

<?php
include "database/getCompetition.php";
?>

<?php 
$compID = $_GET['compID'];
echo "<form method='POST' id='firstForm' name='firstForm' action='database/addAgeClass.php?compID=".$compID."'>";
?>
<p id="chooseP">Välj åldesklass och resp. gren här:</p>

<table class ="createcompTable">
	
      <td>Åldersklass:</td>
	  
      <td colspan="2"> 
		  <select name="chooseClass" id="chooseClass" required>
					<option> - Välj klass - </option>
		 
						<?php
							
							include "database/config.php";
							$query2 = "SELECT * FROM classes";
							
							$data = mysqli_query($con, $query2);
							
							if (!$data) {
							die('Error: ' . mysqli_error($con));
							}
							
							$array=[];
							while($row = $data->fetch_object()) {
								if(!in_array($row->Klass, $array)) {
									array_push($array, $row->Klass);
								}
							}
							sort($array, SORT_DESC);
							foreach ($array as $key => $value) {
							  printf("\t<option value='%s'>%s</option>\n", $value, $value);
							}
							mysqli_close($con); 
						?>
			</select>
		  </td>
        </td>
	 </tr>	 
</table>


<div id="leftPartOfApplication">
</form>
</div>

<!--The Informationtext -->
<script type="text/javascript">	

	console.log($('#chooseClass'));
	var inp = "";
	$('#chooseClass').change(function() {
		inp = $(this).find(":selected").text();
		
		//console.log(inp);
		$.ajax({
			data: {
				'discipline': inp
			},
			url: 'database/getAllDisciplines.php',
			success: function(content) {
				//console.log(content);
				content = $.parseJSON(content);
				var dat_string = '<table id="whichDisciplines">';
				dat_string += '<tr><td><td> <p id ="discP">Gren</th> </p>';
				$.each(content, function(index, value) {
					console.log(value);
					dat_string += '<tr><td><input type = "checkbox" name = "gren[]" value="'+value.gren+'"></td><td>'
								+ value.gren;
				});
				dat_string += '</table>';
				dat_string += '<input type="submit" id="addAgeClass" value="Lägg till Åldersklass"/></form>';
				//dat_string += '<input type="hidden" name="hiddenClass" id="hiddenClass" value="'+inp+'">';

				document.getElementById('leftPartOfApplication').innerHTML = dat_string;
			}
		});
	});
</script>

<form method="POST" id="secForm" name="secForm">
<!--The Informationtext -->
<script type="text/javascript">	
var js_var = "<?php echo $_GET['compID']; ?>";
	$(document).ready(function() {
		
		$.ajax({
		data: {
				
			},
			
			url:'database/getAllAvailableDisciplines.php?compID='+js_var,
			success: function(content2){
				
				content2 = $.parseJSON(content2);
				var dat2_string = '<table id="whichDisciplines">';
				dat2_string += '<tr><td></td> <th><p id ="discP">valda grenar till resp. åldersklass </p></th></tr>';
				$.each(content2, function(index, value) {
				console.log(value);
				console.log(index);
					dat2_string += '<tr><td>'+value.klass+'</td><td>'
								+ value.gren+'</td>';
								+ '<td><button id="deleteButton">Radera</button></td> </tr>';
				});
				dat2_string += '</table>';
				dat2_string += '<input type="submit" id="addAgeClass2" value="färdig!?"/></form>';

				document.getElementById('rightPartOfApplication').innerHTML = dat2_string;
			}
		}); 
	});
</script>
<!-- nästa gång försök fixa deleteknappen för alla grenar resp åldersklasser!!!!! se under!!
<!--+ '<td><a href="database/deleteAddedClass.php?participantId=' + value.participantId + '"><button id="deleteButton">Radera</button></a></td> </tr>';-->
<div id="rightPartOfApplication">
	<h2>Dina anmälda tävlande</h2>
	<div id="confirmedDiv">
	</form>
	</div>
</div>

<div class=progressBar>
	<div class=progress>50% klart</div>
</div>
<?php
include "templates/adminfooter.php";
?>