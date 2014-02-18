<!--bronk-->
<?php
include "templates/header.php";
?>
	<div class="choicebar">
	<form method="post">
	<select name="formGender" id="scrollbar">
		<option value="">Gren</option>
		<option value="M">100m</option>
		<option value="F">Hopp</option>
		<option value="F">Flonk</option>
	</select>
	<input type="button" id="resultbutton" value="Filtrera" onclick="location.href='resultat.php'"/>
	</form>
	</div>
	
	<?php
		session_start();	
	
		$con=mysqli_connect("localhost","root","","tjalve");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
		$result = mysqli_query($con,"SELECT * FROM hojdhopp");
		
		$columns = array();
		
		while ($fieldinfo=mysqli_fetch_field($result))
		{
			$namn= $fieldinfo->name;
			$columns[] = $fieldinfo->name;
		}

		
		
		
		echo"<table border=1 align=center>";
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
		  /*echo "<td>" . $row[$value] . "</td>";
		  echo "<td>" .  $row['Club'] . "</td>";
		  echo "<td>" . $row['Result'] . "</td>";*/
		  
		  
		}
		echo "</tr>";
		echo "<br />";
		}
		
		echo "</table>";
		/*while($row = mysqli_fetch_array($result))
		  {
		  echo $row['first_name'] . " " . $row['last_name'] . " " . $row['Club'] . " " . $row['Time'];
		  echo "<br>";
		 }*/

		mysqli_close($con);
	?>
	
<?php
include "templates/footer.php";
?>