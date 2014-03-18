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
       <!-- Damer:	
          <select id="droplistFemale" onchange="femaleDisplay()">
            <option value="empty"></option>
            <option value="f7">F7</option>
            <option value="f8">F8</option>
            <option value="f9">F9</option>
            <option value="f10">F10</option>
            <option value="f11">F11</option>
            <option value="f12">F12</option>
            <option value="f13">F13</option>
            <option value="f14">F14</option>
            <option value="f15">F15</option>
            <option value="f17">F17</option>
            <option value="k">K</option>
          </select>

        Herrar:	
          <select id="droplistMale" name="droplistMale" onchange="maleDisplay()">
            <option></option>
            <option value="p7">P7</option>
            <option value="p8">P8</option>
            <option value="p9">P9</option>
            <option value="p10">P10</option>
            <option value="p11">P11</option>
            <option value="p12">P12</option>
            <option value="p13">P13</option>
            <option value="p14">P14</option>
            <option value="p15">P15</option>
            <option value="p17">P17</option>
            <option value="h">H</option>
          </select>-->
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
<form id="ageClass" name="ageClass" method="post" action="database/addAgeClass.php"> 
<div id ="chosenAge">Vald ålderssdsklass: <input  id="age" name="age" size="4" ></input></div><!--type="text" disabled style="color:black"-->

<table class ="createcompTable">
  <tr>
    <td>
	textfälten måste anpassa sig efter storleken på fönstret de gör dem inte just nu!!!
      Valbara grenar
    </td>
    <td>
      Valda grenar
  </tr>
  <tr>
    <td>
      <?php include "database/getAllDisciplines.php"; ?>
    </td>
    <td>
      <!--<textarea rows="4" cols="50">Textarea2</textarea>-->
	  <input type="submit" name="submit" value="Spara!!!!!!!!!!!">
    </td>
  </tr>
</table>
</form>
<?php
include "templates/adminfooter.php";
?>