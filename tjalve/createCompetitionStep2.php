
<!--Create competition page-->
<!--Granskad och godkänd 2014-03-04-->

<?php
include "templates/adminheader.php";

include "class/competition.php";
$compID = $_GET['compID'];
$getCompInfo = new Competition();

	echo "<div id='competition'><h1>" . $getCompInfo->getCompName($compID) . "</h1></div>";	
	echo "<table id='bronk'>";
	echo "<tr><td>Arrangör: </td><td>" . $getCompInfo->getCompOrganizer($compID) . "</td></tr>";	
	echo "<tr><td>Tävlingsdatum: </td><td>" . $getCompInfo->getCompDate($compID) . "</td></tr>";	
	echo "<tr><td>Sista anmälningsdag: </td><td>" . $getCompInfo->getCompLastDate($compID) . "</td></tr>";	
	echo "</table>";
	echo "<img id ='compLogo' src=". $getCompInfo->getCompFile($compID) ." alt ='Image' />";
 

//echo "<form method='POST' id='firstForm' name='firstForm' action='database/addAgeClass.php?compID=".$compID."'>";
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
var js_IDvar = "<?php echo $_GET['compID']; ?>";
	//console.log($('#chooseClass'));
	var inp = "";
	$('#chooseClass').change(function() {
		inp = $(this).find(":selected").text();
		
		//console.log(inp);
		$.ajax({
			data: {
				'discipline': inp
			},
			url: 'database/getAllDisciplines.php?compID='+js_IDvar+ '&inp='+inp,
			success: function(content) {
				//console.log(content);
				content = $.parseJSON(content);
				var dat_string = '<table id="whichDisciplines">';
				dat_string += '<tr><td><td> <p id ="discP">Gren</th> </p>';
				$.each(content, function(index, value) {
					//console.log(index);
					console.log(value);
					dat_string += '<tr><td><input type = "checkbox" id = "selectBox" name = "gren[]" value="'+value+'"></td><td>'
								+ value;
				});
				dat_string += '<tr><td colspan="2"><input type="submit" id="addAgeClass" value="Lägg till Åldersklass"/></td></tr></form>';
				//dat_string += '<input type="hidden" name="hiddenClass" id="hiddenClass" value="'+inp+'">';
				dat_string += '</table>';
				document.getElementById('leftPartOfApplication').innerHTML = dat_string;
			}
		});
	});
</script>

<form method="POST" id="secForm" name="secForm" action="admin.php">
<!--The Informationtext -->
<script type="text/javascript">	
var js_var = "<?php echo $_GET['compID']; ?>";
	$(document).ready(function() {
		
		$.ajax({
			url:'database/getAllAvailableDisciplines.php?compID='+js_var,
			success: function(content2){
				
				content2 = $.parseJSON(content2);
				var dat2_string = '<table id="selectedDisciplines">';
				dat2_string += '<tr><td colspan="3"><p id ="selectedDiscP">Valda grenar till resp. åldersklass </p></td></tr>';
				$.each(content2, function(index, value) {
				console.log(value);
				console.log(index);
					dat2_string += '<tr><td>' +value.klass+ '</td><td>'
								+ value.gren+ '</td><td><button id="deleteButton"><a id="aTagDeleteDisp" href="database/deleteDiscipline.php?compID=' + js_var + '&gren=' +value.gren+ '&klass=' +value.klass+ '">Radera</a></button></td> </tr>';
				});
				dat2_string += '<tr><td><td><td><input type="submit" id="done" value="Klar"/></td></td></td></tr></form>';
				dat2_string += '</table>';

				document.getElementById('rightPartOfApplication').innerHTML = dat2_string;
			}
		}); 
	});
</script>

<div id="rightPartOfApplication">
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


<!-- 	OBSOBS!!!!! gör om gör rätt!!!!
		ändra detta nu eller när vi fixat classerna och allt funkar igen som de ska???

		kunna lägga till nya grenar som inte finns i databasen.
		i createCompetition: en extra ifyllning för datum om tvävlingen går över flera dagar alltså ifyllning för ett startdatum och en ifyllning för ett slutdatum.
		skapany eller kopiera gammla tävling så den kopierade tävlingen får ett nytt tävlingsID.
		sortera på rätt sätt både åldersklass och grenar OBS! även de grenar som läggs till i databasen ska kunna sorteras in på rätt plats
		ska man kunna tabort gren som skapas?????? lås standard grenar (+200 häck) resten "egentilllagda grenar" ska man kunna ta bort tex om man lägger till "40 meter sprint baklänges" vill man inte ha kvar de efter plojtävlingen är avslutad.
		internet explorer????? kanske ska tänka på om de är värt de... skulle kanske kunna funka på kolla resultat och anmäla sig till tävling 
		
		-->
