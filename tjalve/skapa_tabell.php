<?php
		include("resultat.php");
		session_start();	
	
		$con=mysqli_connect("localhost","root","","tjalve");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
		  if (isset($_POST["drop"])) 
			{
				$choice = mysql_real_escape_string($_POST["drop"]); //$_POST["drop"];
				echo $choice;
				echo " is choice";
			} 
			else 
			{
					$choice = null;
				echo "no choice supplied";
			}
			//var_dump($_POST);
		//$selectedText = $("#dropdown option:selected").text();
		/*if($_POST['submit']){
		
			$gren = $_POST['formGender'];
			$result = mysqli_query($con,"SELECT * FROM $_GET[]");
			
		}*/
		$result = mysqli_query($con,"SELECT * FROM $choice");
		
		$columns = array();
		
		while ($fieldinfo=mysqli_fetch_field($result))
		{
			$namn= $fieldinfo->name;
			$columns[] = $fieldinfo->name;
		}

		
		echo"<table border=1 align= center class=\"firstTableList\">";
		//echo"<table border=1 align= center >";
		foreach ($columns as $value)
		{
			echo "<td> $value </td>";
		}
		
		
		
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
		

		mysqli_close($con);
		
	?>