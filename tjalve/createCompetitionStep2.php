<!--Create competition page-->
<!--Granskad och godkänd 2014-03-04-->

<?php
include "templates/adminheader.php";
?>

<div id="comp">
		<?php
		include "database/getCompetition.php";
		?>
</div>

Välj åldesklass och resp. gren här:

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

<form method="post" id="firstForm" name="firstForm" action="database/add_class.php"> 
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
				dat_string += '<tr><td></td> <th>Gren</th> </tr>';
				$.each(content, function(index, value) {
				console.log(value);
					dat_string += 	'<tr><td><input type = "checkbox" discipline = "gren[]" value="'+value.gren+'"/></td><td>'
									 + '<div id = "'+value.gren+'">' +value.gren+ '</div>' //Lyckas jag verkligen döpa divId på det sättet jag vill??? hur ska man kunna ändra en div utan att hela sidan uppdateras???
									 //+ '</td><td>'+inp+'</td><td>'
				});
				dat_string += '</table>';
				dat_string += '<input type="submit" discipline="addAgeClass" id="addAgeClass" value="Lägg till Åldersklass"/></form>';

				document.getElementById('leftPartOfApplication').innerHTML = dat_string;
			}
		});
	});
</script>

<div class=progressBar>
	<div class=progress>50% klart</div>
</div

<?php
include "templates/adminfooter.php";
?>