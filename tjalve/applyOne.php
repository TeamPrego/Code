<?php
	include "templates/header.php";
?>	
<!--Granskad och godkänd 2014-03-04-->

<!--Headning -->
<h1> Anmälan till "tävlingsnamn" </h1>
<!--Line -->
<hr>
<h2>Steg ett</h2>
<!--Div for the form -->
<div id="leftPartOfApplication">
	<table class ="formDiv">
		<form id="firstForm" name="firstForm" method="post" action="addContactPerson.php"> 
			<tr>
				<td>
					<label for="select">
						Välj klubb:
					</label>
				</td>
				<td>
					<select>
						<?php
							error_reporting(E_ALL);
	  						ini_set("display_errors", 1);
							include "database/config.php";
							$data = mysqli_query($con, "SELECT Name FROM clubs");
							$count = 0;
							while($row = $data->fetch_object()) {
									echo "<option value='" .$count. "'>" .$row->Name. "</option>";
									$count = $count + 1;
								}					
						?>
					</select>
					Saknas din förening?
					<a id="addTeam" href="createNewClub.php">Klicka här</a>
				</td>
			</tr>

			<tr>
				<td>Kontaktperson:</td>
				<td><input type="text" name="contactPerson" id="contactPerson" placeholder="Namn"required></input></td>
			</tr>
			
			<tr> 
				<td>E-mail:</td>
				<td><input type="email" name="email" id="email" placeholder="namn@exempel.se" required></input></td>
			</tr>
			
			<tr>
				<td>Upprepa e-mail:	</td>
				<td><input type="email" name="repeatEmail" id="repeatEmail" placeholder="namn@exempel.se" required></input></td> 
			</tr>
			
			<tr>
				<td>Telefon:</td>
				<td><input type="text" name="phonenumber" id="phoneNumber" placeholder="ex 07x-xxx xxx xx"required></input></td>
			</tr>
			
			<tr>
				<td></td>
				<td><a href="applyTwo.php"><input type="submit" name="continues" id="continues" value="Fortsätt"></a></td>
			</tr>
		</form>
	</table>
</div>

<!--The Informationtext -->
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery(".infoText").hide();
		//toggle the componenet with class msg_body
		jQuery(".cthrough").click(function(e) {
			e.preventDefault();
			jQuery(this).next(".infoText").slideToggle(500);
		});
	});	
</script>
<a id="dropDown" href="#" class="cthrough">För hjälp, klicka här</a>
<div class="infoText">
	<h4>För instruktion:</h4>
	<ol>
		<li class="importantText">
      Välj klubb och skriv in uppgifter om kontaktpersonen
    </li>
		<li>
      I nästa formulär skriver du in deltagarens namn, födelseår och huvudklass. Om det är stafett kryssa i stafettanmälan och klubbnamn går in som efternamn och du kan sedan skriva in om det är Lag 1 osv, 
			Kryssa därefter i önskade grenar och ev PB/SB, tryck på knappen "Lägg till deltagare"
    </li>
		<li>
      Skall deltagaren vara med i en gren i en annan klass, ändra klassen i klasslistan och välj grenar och tryck på knappen "Lägg till extra gren". Du ska alltså inte skriva in namnet igen.
			Skulle du råka lägga till fel gren kan du ta bort grenen i grenlistan, på det röda krysset
    </li>
		<li>
      Upprepa ovan för alla dina deltagare och klicka sedan på "Visa alla", så ser du alla dina anmälningar. Samtidigt får du också ett mail med bekräftelse på din anmälan.
	 		Alla anmälda syns direkt i startlistan så fort du gjort färdigt din anmälan. Om en deltagare inte syns har anmälan inte lyckats. Försök i första hand igen och var noga med att följa instruktionerna 
			Skulle du få några problem maila till mail@mailadress.se
			Skriv gärna ut denna instruktion och ha den till hands innan du går vidare.
			Lycka till
    </li>
	</ol>
</div>

<!--The Progress Bar -->
<div class=progressBar>
	0% klart
</div>
	
<?php
	include "templates/footer.php";
?>