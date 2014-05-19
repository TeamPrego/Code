<!--Primary admin page-->
<?php
include "templates/adminheader.php";
?>

<!--Heading for this pages-->
<h1>Skapa avprickningslista</h1>

<!--A Line -->
<hr>

<!-- Dropdownlist with all competitions -->
<div class="selectBox">
	<form method="post" action="#">
	<label>Välj Tävling:</label>
	<select id="competitionsInvoicing" autofocus>
	<!--All competitions will be included here-->
	</select>

	<label>Välj Klass:</label>
	<select id="classInvoicing">
	<!--All classes will be here-->
	</select>
</div>



<script type="text/javascript">
// Global variable
var competitionName = "";

	// When the pages has been loaded do this
	// Load all competitions in the dropdownlist
	jQuery(document).ready(function() {
		$.ajax({
			url: '../Ajax/ajax.php?getAllCompetitions=1',
			success: function(content) {
				content = $.parseJSON(content);
				var string = "";
				var substring = "";
				$.each(content, function(index, value) {
					string += '<option id="'+value.competitionId+'"name="'+value.competitionName+'">'+value.competitionName;
				});
				// Include the whole string in the div called competitionsInvoicing
				document.getElementById('competitionsInvoicing').innerHTML = string;
				// The last competition read from database will be chosen
				$('#competitionsInvoicing').val(substring);
				// Trigger a change in the competition downdownlist
				$('#competitionsInvoicing').trigger("change");
			}
		});
	});

	// If a change is done in the competition dorpdownlist
	$('#competitionsInvoicing').change(function() {

		// Set competitionId and competitionName
		var competitionId = $(this).find("option:selected").attr('id');
		competitionName = $(this).find("option:selected").attr('name');

			// time to get all classes who is reg in one competition
			$.ajax({
			url: '../Ajax/ajax.php?getYearClassesByCompId=1&competitionId='+competitionId,
			success: function(content) {
				// parse the content
				content = $.parseJSON(content);
				// This string should contain all HTML-code which will be send to the div
				var string ="";
				$.each(content, function(index, value) {
					string += '<option id="'+value.yearClass+'">'+ value.yearClass +'</option>';
				});
				// Include the whole string in the div called clubInvoicing
				document.getElementById('classInvoicing').innerHTML = string;

				// Trigger a change in the club-dropdown list
				$('#classInvoicing').trigger("change");
			}
		});
	});

	// If the class-dropdownlist is changed
	$('#classInvoicing').change(function() {
		// Get the class name
		var yearclass = $(this).find("option:selected").attr('id');
	
	});

</script>

<?php
	// include the footer for admin-pages
	include "templates/adminfooter.php";
?>