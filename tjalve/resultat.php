<?php
include "templates/header.php";
?>
	
	<h1 id="title">Välkommen</h1>
	
	<form action = "skapa_tabell.php" method="post" class="choice-bar">
		<select name="drop-list" id="drop-list">
			<option value="noChoice">Välj gren</option>
			<option value="100m">100m</option>
			<option value="hojdhopp">hojdhopp</option>
			<option value="flonk">Flonk</option>
		</select>
		<input type="submit" id="result-button">
	</form>
		
<?php
include "templates/footer.php";
?>