<!--Granskad och godkänd 2014-03-04-->
<?php
session_start();
	include "templates/adminheader.php";
?>	

<!--Headning -->
<h1>Redigera anmälan</h1>
<!--Line -->
<hr>

<h2>Sök efter deltagare</h2>

<!--The Form Part Two -->
<div id="leftPartOfApplication">
	<table class ="formDiv">
			<tr>
				<td>Förnamn</td>
				<td>Efternamn</td>
				<td>Födelseår</td>
				<td>Klass</td>
				<td>Gren</td>
				<td>Klubb</td>
				<td>Uppdatera</td>
				<td>Spara uppdatering</td>
				<td>Ta bort deltagare</td>
			</tr>
			<?php
				include "database/EditParticipants/findAllParticipants.php";
			?>
	</table>
</div>

<!--The Progress Bar -->
<div class=progressBar>
	<div class=progress>50% klart</div>
</div
	
<?php
	include "templates/adminfooter.php";
?>

