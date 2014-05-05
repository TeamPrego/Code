
<!--Create competition page-->
<!--Granskad och godkänd 2014-03-04-->

<?php
include "templates/adminheader.php";
include "class/competition.php";

$compID = $_GET['compID'];
$getCompInfo = new Competition();
  //prints all info from the prev.page. To "check" what the user typed in earlier 
	echo "<div id='competition'><h1>" . $getCompInfo->getCompName($compID) . "</h1></div>";	
	echo "<table id='bronk'>";
	echo "<tr><td>Arrangör: </td><td>" . $getCompInfo->getCompOrganizer($compID) . "</td></tr>";	
	echo "<tr><td>Tävlingsdatum: </td><td>" . $getCompInfo->getCompDate($compID) . "</td></tr>";	
	echo "<tr><td>Sista anmälningsdag: </td><td>" . $getCompInfo->getCompLastDate($compID) . "</td></tr>";	
	echo "</table>";
	echo "<img id ='compLogo' src=". $getCompInfo->getCompFile($compID) ." alt ='Image' />";
?>

<!-- chose yearclass -->
<form method="POST" id="firstForm" name="firstForm" action="createCompetitionStep2.php">
<p id="chooseP">Välj åldesklass och resp. gren här:</p>

<table class ="createcompTable">
  <td>Åldersklass:</td>  
    <td colspan="2"> 
      <select name="chooseClass" id="chooseClass" required>
      <option> - Välj klass - </option>
        <?php
          //get all yearclasses possible and "print" them in a dropdown list
          $allyearclasses = new competition();
          $allyearclasses->getAllYearClasses();
        ?>
			</select>
		  </td>
    </td>
	 </tr>	 
</table>

<!--div to place the different disciplines available for a chosen yearclass-->
<div id="leftPartOfApplication">
</form>
</div>

<!-- check which yearclass that is chosen and then get the available disciplines, print them with associated checkboxes  -->
<script type="text/javascript">	
var js_IDvar = "<?php echo $_GET['compID']; ?>";
	var inp = "";
	$('#chooseClass').change(function() {
		inp = $(this).find(":selected").text();
		$.ajax({
			data: {
				
			},
			url: 'Ajax/ajax.php?competitionID='+js_IDvar+'&inp='+inp,
			success: function(content) {
				content = $.parseJSON(content);
				var dat_string = '<table id="whichDisciplines">';
				dat_string += '<tr><td><td> <p id ="discP">Gren</th> </p>';
				$.each(content, function(index, value) {
					console.log(value);
					dat_string += '<tr><td><input type = "checkbox" id = "selectBox" name = "gren[]" value="'+value+'"></td><td>'
								+ value;
				});
				dat_string += '<tr><td colspan="2"><input type="submit" name = "submit" id="addAgeClass" value="Lägg till Åldersklass"/></td></tr></form>';
				dat_string += '</table>';
				document.getElementById('leftPartOfApplication').innerHTML = dat_string;
				document.cookie = "compID = " +js_IDvar;
			}
		});
	});
</script>

<!--print the disciplines associated with a specific yearclass that are chosen by the user-->
<div id="rightPartOfApplication">
	<div id="confirmedDiv">
	<form method="POST" id="secForm" name="secForm" action="createCompetitionStep2.php">

		<!-- get all disciplines that the user have selected and print them, with there own deletebutton to remove them if teh user have done something wrong-->
		<script type="text/javascript">	
		var js_IDvar = "<?php echo $_GET['compID']; ?>";
			$(document).ready(function() {
				$.ajax({
					data: {
						
					},
						url: 'Ajax/ajax.php?compID='+js_IDvar,
						success: function(content) {
						content = $.parseJSON(content);
						var dat2_string = '<table id="selectedDisciplines">';
						dat2_string += '<tr><td colspan="3"><p id ="selectedDiscP">Valda grenar till resp. åldersklass </p></td></tr>';
						$.each(content, function(index, value) {
							var link = 'Ajax/ajax.php?compId=' + js_IDvar + '&grenId=' +value.Id+ '&klass=' +value.klass;
							dat2_string += '<tr><td>' +value.klass+ '</td><td>'
										+ value.gren + '</td><td><button id="deleteButton"><a id="aTagDeleteDisp" href='+link+'>Radera</a></button></td> </tr>';
						});				
						dat2_string += '<tr><td><td><td><input type="submit" id="done" value="Klar"/></td></td></td></tr></form>';
						dat2_string += '</table>';
						document.getElementById('rightPartOfApplication').innerHTML = dat2_string;
					}
			});
		});
		</script>
	</form>
	</div>
</div>

<div class=progressBar>
	<div class=progress>50% klart</div>
</div>
<?php
include "templates/adminfooter.php";
?>

<?php
	if(isset($_POST['submit'])){
		$temp = new Competition();
		$temp->addAgeClass($_COOKIE['compID'], $_POST['gren'], $_POST['chooseClass']);
	}
?>

<!-- 	OBSOBS!!!!! gör om gör rätt!!!!
		ändra detta nu eller när vi fixat classerna och allt funkar igen som de ska???

		kunna lägga till nya grenar som inte finns i databasen.
		
		skapany eller kopiera gammla tävling så den kopierade tävlingen får ett nytt tävlingsID.
		sortera på rätt sätt både åldersklass och grenar OBS! även de grenar som läggs till i databasen ska kunna sorteras in på rätt plats
		ska man kunna tabort gren som skapas?????? lås standard grenar (+200 häck) resten "egentilllagda grenar" ska man kunna ta bort tex om man lägger till "40 meter sprint baklänges" vill man inte ha kvar de efter plojtävlingen är avslutad.
		internet explorer????? kanske ska tänka på om de är värt de... skulle kanske kunna funka på kolla resultat och anmäla sig till tävling 
		
		-->
