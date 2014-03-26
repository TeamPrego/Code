<?php
include "templates/adminheader.php";
?>




<?php
$odd=0;
include "database/config.php";
//$contactId = $_GET['contactId'];
	$query = "SELECT * FROM competition WHERE 1";
	$data = mysqli_query($con, $query);
	
	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}

	
  echo"<div>";
  //echo "<form action = '' method='post' class='choice-bar'>";
  //echo "<select name='chooseCompetition' id='chooseCompetition'>";
  
  echo "<select name='createTable' id='createTable' value='createTable'>";
  echo "<option value='noChoice'>Välj Tävling</option>";
  while($row = $data->fetch_object()){
   echo "<option value='" .$row->compName. "'>" .$row->compName. "</option>";
  }
  echo"</select>";
  
  //echo "<input type='button' name='createTable' id='createTable' value='createTable'>";
  //echo "</form>";
  echo "</div>";
  
	mysqli_close($con);	
?>



<script type="text/javascript">
//var ID=0;
$('#createTable').change(function() {
    
		var competition =  $('#createTable').find(":selected").text();
    
		$.ajax({
      async: false,
      //Skapar tabellen för tävling
			
      url: 'database/getCompetitionByName.php?competition='+competition+'',
      
     
			success: function(content){
          
        
        content = $.parseJSON(content);        
        
        var dat_string = '<table id="competitionTable">';
				dat_string += '<tr> <th>ID</th> <th>Name</th> <th>Arr</th> <th>Date</th> <th>LastDate</th></tr>';
        
        dat_string+='<tr><td>'+content.compID+'</td><td>'+content.compName+'</td><td>'+content.compArr+'</td><td>'+content.compDate+'</td><td>'+content.compLastDate+'</td></tr>' 
        
        dat_string += '</table>';
        document.getElementById('table').innerHTML = dat_string;
        
        ID = content.compID;
        console.log(ID);
			}
      
		});
    
    //document.write(ID);
    $.ajax({
      /*
        Skriver ut grenar från en tävling
      */
      async: false,
      url: 'database/getAgeClassById.php?ID='+ID+'',
      
      
      success: function(content){
         console.log(ID);
        content = $.parseJSON(content);
        
        console.log(content);
        
        
        var dat_string2 = '<table id="competitionTable2">';
				dat_string2 += '<tr> <th>ageclass</th> <th>discipline</th></tr>';
        
        $.each(content, function(index, value) {
        dat_string2+='<tr><td>'+value.ageC+'</td><td>'+value.disc+'</td></tr>' 
        });
        dat_string2 += '</table>';
        document.getElementById('table2').innerHTML = dat_string2;
        
			}
      
		});
    /*
    $.ajax({
      /*
        Skriver ut grenar från en tävling
      */
      /*
      url: 'database/getAgeClassById.php?ID='+ID+'',
      
      success: function(content){
        
        content = $.parseJSON(content);
        
        console.log(content);
        
        
        var dat_string2 = '<table id="competitionTable2">';
				dat_string2 += '<tr> <th>ageclass</th> <th>discipline</th></tr>';
        
        $.each(content, function(index, value) {
        dat_string2+='<tr><td>'+value.ageC+'</td><td>'+value.disc+'</td></tr>' 
        });
        dat_string2 += '</table>';
        document.getElementById('table2').innerHTML = dat_string2;
        
			}
      
		});*/
    
});
  

</script>

<div id="table">Här ska skit dyka upp</div>
<div id="table2">Här ska skit dyka upp</div>

<?php
include "templates/adminfooter.php";
?>