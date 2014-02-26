<?php
include "templates/header.php";
?>
	
	<h1 id="title">Välkommen</h1>
	<div>
	<form action = "" method="post" class="choice-bar">
		<select name="drop-list" id="drop-list">
			<option value="noChoice">Välj gren</option>
			<option value="100m">100m</option>
			<option value="hojdhopp">hojdhopp</option>
			<option value="flonk">Flonk</option>
		</select>
		<input type="submit" id="result-button">
	</form>
	</div>
  
  <?php
		
  session_start();	
	
  //Choose which database to connect to. The first one is for 
  //binero. It is not working from localhost. The second one is for your 
  //local database. You might need to change database name (tjalve) etc.
  //$con=mysqli_connect("competition-192031.mysql.binero.se","192031_jv80473","TeamPrego","192031-competition");
	$con=mysqli_connect("localhost","root","","tjalve");
	//Test Connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
    //Gets info from drop-list
		if (isset($_POST["drop-list"])) 
		{
      //Runs if and only if the user have made a choice
			if($_POST["drop-list"] != "noChoice")
			{ 
        //Creates a proper sql-string and chooses the right table from it
				$choice = mysqli_real_escape_string($con, $_POST["drop-list"]);
				$result = mysqli_query($con,"SELECT * FROM $choice");
				//creates an array for column names
        $columns = array();
				
        //Saves data as long as their is new data to get. 
        //columns is column-names (fornamn, efternamn etc)
				while ($fieldinfo=mysqli_fetch_field($result))
				{
          //namn seems unneccesary
					//$namn= $fieldinfo->name;
					$columns[] = $fieldinfo->name;
				}
        
        //Begin creating table. OBS! firstTableList not working properly
				echo"<table border=1 align= center class=\"result-table\">";
				//Adds new column
				foreach ($columns as $value)
				{
					echo "<td> $value </td>";
				}
				//Add entries. Name of competitors, club etc
				while($row = mysqli_fetch_array($result))
				{
					echo"<tr>";
					
					foreach ($columns as $value)
					{
						echo "<td>" . $row[$value] . "</td>"; 		  
					}
				
					echo "</tr>";
					echo "<br />";
				
				}
				
				echo "</table>";
        //close connection
				mysqli_close($con);
			}
		} 
    /*
		else 
		{
			$choice = null;
			echo "no choice supplied";
		}*/
		
	?>
  
  wazzupp maddafacka;
<?php
include "templates/footer.php";
?>