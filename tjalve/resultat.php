<!--bronk-->
<?php
include "templates/header.php";
?>
	
	<!--<script>
	function getChoice()
	{
		var x = document.getElementById("scrollbar");
		var strUser = x.options[x.selectedIndex].text;
		document.getElementById("title").innerHTML = strUser;
	}
	</script>-->

	<!--<script src="resultat.js"></script>-->
	<h1 id="title">Välkommen</h1>
	<div class="choicebar">
	
	<form action = "skapa_tabell.php" method="post">
	<select type="text" name="drop" index="drop">
		<option value="100m">100m</option>
		<option value="hojdhopp">hojdhopp</option>
		<option value="flonk">Flonk</option>
	</select>
	<input type="submit">
	</form>
	</div>
	
	
<?php
include "templates/footer.php";
?>