<?php
	include "templates/header.php";
?>	
<h1>Startlista för <?php include "database/startList/getCompetitionName.php" ?></h1>
<label>Välj klubb: </label>
<select name="chooseClass" id="chooseClass" required>
	<option value="all">Alla</option>
	<?php
		include "database/config.php";
		$competitionId = $_GET['competitionId'];
		$dataClass = mysqli_query($con, "SELECT * FROM age_class WHERE compId= '$competitionId'");
		$array=[];
		while($row = $dataClass->fetch_object()) {
			if(!in_array($row->ageClass, $array)) {
				array_push($array, $row->ageClass);
				echo "<option value='" .$row->ageClass. "'>" .$row->ageClass. "</option>";
			}
		}
	?>
</select>
<label>Välj gren: </label>
<select name="chooseDiscipline" id="chooseDiscipline" required>
	<option value="all">Alla</option>
	<?php
		include "database/config.php";
		$competitionId = $_GET['competitionId'];
		$dataDescipline = mysqli_query($con, "SELECT * FROM age_class WHERE compId= '$competitionId'");
		$array=[];
		while($row = $dataDescipline->fetch_object()) {
			if(!in_array($row->discipline, $array)) {
				array_push($array, $row->discipline);
				echo "<option value='" .$row->discipline. "'>" .$row->discipline. "</option>";
			}
		}
	?>
</select>

<div id="startList">
</div>

<script type="text/javascript">
$(document).ready( function () {
  Update();
});

$('#chooseClass').change(function() {
	Update();
});

$('#chooseDiscipline').change(function() {
	Update();
});

function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null;
}

function Update() {
	var ageClass = $('#chooseClass').find(":selected").text();
	var discipline = $('#chooseDiscipline').find(":selected").text();
	var competitionId = getURLParameter("competitionId");
	$.ajax({
		url: 'database/startList/getStartList.php?ageClass='+ageClass+'&discipline='+discipline+'&competitionId='+competitionId+'',
		success: function(content) {
			console.log(content);
			content = $.parseJSON(content);
			var dat_string = 	'<table class ="firstTableList" cellspacing="0" cellpadding="0">';
			$.each(content, function(index, value) {
				dat_string += '<tr class="spaceOver"><td style="background-color:white"></td></tr>';
				dat_string += 	'<tr><th>'+ value.className + '</th><th> ' + value.discipline +'</th><th></th><th></th></tr><tr><th></th><th>Förnamn</th><th>Efternamn</th><th>Klubb</th></tr>';
				$.each(value.participants, function(ind, val) {
					dat_string += '<tr><td></td><td>' + val.firstName + '</td><td>' + val.lastName + '</td><td>' + val.club + '</td></tr>';
				});
			});
			dat_string += '</table>'
			document.getElementById('startList').innerHTML = dat_string;
		}
	});
}
</script>

<?php
	include "templates/footer.php";
?>