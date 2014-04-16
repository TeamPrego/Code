<select name="chooseClass" id="chooseClass" required>
<option> - Välj klass - </option>
	<?php
		include "database/config.php";
		if (!$_GET['competitionId']){
			$getCompId = mysqli_query($con, "SELECT * FROM contact WHERE contactId = '$_GET[contactId]'");
			$competitionId = $getCompId->fetch_object()->competitionId;
		}
		else 
			$competitionId = $_GET['competitionId'];
		$data = mysqli_query($con, "SELECT * FROM competitiondisciplines WHERE competitionId= '$competitionId'");
		$array=[];
		while($row = $data->fetch_object()) {
			if(!in_array($row->yearClass, $array)) {
				array_push($array, $row->yearClass);
				echo "<option value='" .$row->yearClass. "'>" .$row->yearClass. "</option>";
			}
		}
	?>
</select>