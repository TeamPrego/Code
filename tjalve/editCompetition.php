<?php
include "templates/adminheader.php";
?>

<?php
$odd=0;
include "database/config.php";
//$contactId = $_GET['contactId'];
	$query = "SELECT * FROM competition WHERE 1";
	$data = mysqli_query($con, $query);
	
	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	
  echo"<div>";
  echo "<form action = \"\" method=\"post\" class=\"choice-bar\">";
  echo "<select name=\"comp-list\" id=\"drop-list\">";
  echo "<option value='noChoice'>Välj Tävling</option>";
  while($row = $data->fetch_object()){
   echo "<option value='" .$row->compName. "'>" .$row->compName. "</option>";
  }
  echo"</select>";
  echo "<input type=\"submit\" id=\"result-button\">";
  echo "</form>";
  echo "</div>";
  
  
  if (isset($_POST["comp-list"])){
    //Runs if and only if the user have made a choice
    if($_POST["comp-list"] != "noChoice") { 
      //Creates a proper sql-string and chooses the right table from it
      $choice = mysqli_real_escape_string($con, $_POST["comp-list"]);
      $result = mysqli_query($con,"SELECT * FROM competition WHERE compName='$choice'");
      
      //Saves data as long as their is new data to get. 
      //columns is column-names (fornamn, efternamn etc)
      while ($fieldinfo=mysqli_fetch_field($result)) {
        $columns[] = $fieldinfo->name;
      }
      
      //Begin creating table. OBS! firstTableList not working properly
      echo "<form action = \"updateCompetition.php\" method=\"post\" class=\"choice-bar\">";
      echo"<table align= center class=\"firstTableList\">";
      //Adds new column
      
      foreach ($columns as $value) {
        echo "<th class=\"odd\"> $value </th>";
      }
      
      $row = $result->fetch_object();   
        //echo "<form action = \"updateCompetition.php\" method=\"post\" class=\"choice-bar\">";
        echo"<tr class=\"odd\">";
        echo "<td><input name=\"compID\" id=\"compID\" value=" . $row->compID . " ></input></td>"; 
        echo "<td><input name=\"compName\" id=\"compName\" value=" . $row->compName . "></input></td>";
        echo "<td><input name=\"compArr\" id=\"compArr\" value =" . $row->compArr . "></input></td>";
        echo "<td><input name=\"compDate\" id=\"compDate\" value =" . $row->compDate . "></input></td>";
        echo "<td><input name=\"compLastDate\" id=\"compLastDate\" value =" . $row->compLastDate . "></input></td>";
        echo "</table>";
        echo "<input type=\"submit\" id=\"edit-button\" value=\"Uppdatera\">";
        echo "</form>";
        
        /*Below is code for showing classes and disciplines
        Might try to shorten code length later
        */
        
        //Creates a proper sql-string and chooses the right table from it
      //var_dump($choice);
      $result2 = mysqli_query($con,"SELECT * FROM age_class WHERE compID =" . $row->compID.  ""); //. $row->compID. "");
      //var_dump($result2);
      //Begin creating table. 
     
      echo"<table align= center class=\"firstTableList\">";
      //Adds new column
      //Add entries. Name of competitors, club etc
      while($row = mysqli_fetch_object($result2)) {
        if($odd % 2 != 0) {
          echo"<tr class=\"odd\">";
        }
        else {
          echo"<tr class=\"even\">";
        }
        
        $odd++;
        
        
          echo "<td>" . $row->ageClass . "</td>";
          echo "<td>" . $row->event . "</td>";

      
        echo "</tr>";
      }
      
      echo "</table>";
    }
  }
	mysqli_close($con);	
  //var_dump(compID);
?>




<?php
include "templates/adminfooter.php";
?>