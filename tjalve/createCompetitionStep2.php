<!--Create competition page-->
<!--Granskad och godkänd 2014-03-04-->

<?php
include "templates/adminheader.php";
?>


<?php
include "database/getCompetition.php";
//$compID = $_GET['compID'];
?>

<form method="post" id="firstForm" name="firstForm" action="database/addAgeClass.php?compID=4"'<?php echo $compID?>'>

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
									echo "<option value='" . $row->Klass . "'>" . $row->Klass . "</option>";
								}
							}
							mysqli_close($con); 
						?>
			</select>
		  </td>
        </td>
     <script src="createCompetition.js"></script>
	 </tr>	 
	
</table>


<div id="leftPartOfApplication">

</form>
</div>

<!--The Informationtext -->
<script type="text/javascript">	

	console.log($('#chooseClass'));

	$('#chooseClass').change(function() {
		var inp = $(this).find(":selected").text();
		console.log(inp);
		$.ajax({
			data: {
				'discipline': inp
			},
			url: 'database/getAllDisciplines.php',
			success: function(content) {
				console.log(content);
				content = $.parseJSON(content);
				var dat_string = '<table id="whichDisciplines">';
				dat_string += '<tr><td><td> <p id ="discP">Gren</th> </p>';
				$.each(content, function(index, value) {
				console.log(value);
				//dat_string += '<input type="hidden" name="inp" value="'+inp+'"/>'
					dat_string += '<tr><td><input type = "checkbox" name = "gren[]" value="'+value.gren+'"/></td><td>'
									 + value.gren
				});
				dat_string += '</table>';
				dat_string += '<input type="submit" discipline="addAgeClass" id="addAgeClass" value="Lägg till Åldersklass"/></form>';

				document.getElementById('leftPartOfApplication').innerHTML = dat_string;
			}
		});
	});
</script>

<div id="rightPartOfApplication">
	<h2>Dina anmälda tävlande</h2>
	<div id="confirmedDiv">
		<?php
		include "getAvailableDisciplines.php"; //kommer troligtvis behöva göra en ny för hannes hämtar inte "class" från samma ställe som jag vill hämta ifrån...
		?>
	</div>
</div>

<div class=progressBar>
	<div class=progress>50% klart</div>
</div

<?php
include "templates/adminfooter.php";
?>