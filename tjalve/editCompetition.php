<?php
include "templates/adminheader.php";
?>

<?php
include "database/config.php";
//$contactId = $_GET['contactId'];
	$query = "SELECT * FROM competition WHERE 1";
	$data = mysqli_query($con, $query);
	
	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	$count = 0;
  echo"<div>";
  echo "<form action = \"\" method=\"post\" class=\"choice-bar\">";
  echo "<select name=\"drop-list\" id=\"drop-list\">";
  echo "<option value='Comp'>Välj Tävling</option>";
  while($row = $data->fetch_object()){
   echo "<option value='" .$row->compName. "'>" .$row->compName. "</option>";
  }
  echo"</select>";
  echo "</form>";
  echo "</div>";
	/*while($row = $data->fetch_object()) {
		echo "<div class='choice-bar'><tr> <td>" . $row->compName . "</td> <td> " . $row->compArr . "</td> <td></td> <td></td> </tr>" . 
		"<tr> <td></td> <td>" . $row->compDate . "</td> <td> " . "Gren" . 
		"</td><td><a href='database/deleteParticipants.php?participantId=".$row->participantId."'><button id='deleteButton'>Radera</button></a></td> </tr></table></div>";
		$count = $count + 1;
	}*/

	mysqli_close($con);	
?>




<?php
include "templates/adminfooter.php";
?>