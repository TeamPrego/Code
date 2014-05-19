<!--Primary admin page-->
<?php
include "templates/adminheader.php";
include "../class/competition.php";
?>

<!--Heading for this pages-->
<h1>Skapa avprickningslista</h1>

<!--A Line -->
<hr>
<div class="selectBox">
	<form method="post" action="#">

	<label>Välj Tävling: </label>
	<select name="chooseCompetition" id="chooseCompetition" required>
		<?php
			$competitionId = $_GET['competitionId'];
			$allCompetitions = getAllCompetitionsToArray();
			foreach ($allCompetitions as $competition)
				echo "<option value='" .$competition['competitionId']. "'>" .$competition['competitionName']. "</option>";
		?>
	</select>

	<script type="text/javascript">

	// Global variable
	var competitionId = "";

	$(function(){
  		$("#chooseCompetition").change(function(){
  			
    		competitionId = $('#chooseCompetition').find("option:selected").attr('id');
    		document.write(competitionId);
    		$('#chooseClass').trigger("change");
  		});
	});
</script>
	
	<!--This is an dropdown-list this all different classes in the competition-->
	<label>Välj klass: </label>
	<select name="chooseClass" id="chooseClass" required>
		<?php
			$competitionId = $_GET['competitionId'];
			$classes = getAllClassesFromCompetition($competitionId); 
			foreach ($classes as $theClass)
				echo "<option value='" .$theClass. "'>" .$theClass. "</option>";
		?>
	</select>

	<!--This is an dropdown-list this all different disciplnes in the competition-->
	<label>Välj gren: </label>
	<select name="chooseDiscipline" id="chooseDiscipline" required>
		<?php
			$competitionId = $_GET['competitionId'];
			$discilines = getAllDisciplinesFromCompetition($competitionId); 
			foreach ($discilines as $theDisciline)
				echo "<option value='" .$theDisciline. "'>" .$theDisciline. "</option>";
		?>
	</select>-->
	</form>
</div>







<?php
	// include the footer for admin-pages
	include "templates/adminfooter.php";
?>