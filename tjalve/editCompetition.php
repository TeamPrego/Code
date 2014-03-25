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
  
  
  
  
  //if (isset($_POST["comp-list"])){
    //Runs if and only if the user have made a choice
    //if($_POST["comp-list"] != "noChoice") { 
      //Creates a proper sql-string and chooses the right table from it
      //$choice = mysqli_real_escape_string($con, $_POST["drop-list"]);
      //$result = mysqli_query($con,"SELECT * FROM competition WHERE compName='$choice'");
      
      //Saves data as long as their is new data to get. 
      //columns is column-names (fornamn, efternamn etc)
     /* while ($fieldinfo=mysqli_fetch_field($result)) {
        $columns[] = $fieldinfo->name;
      }*/
      
      //Begin creating table. OBS! firstTableList not working properly
      /*echo "<form action = \"updateCompetition.php\" method=\"post\" class=\"choice-bar\">";
      echo"<table align= center class=\"firstTableList\">";*/
      //Adds new column
      
      /*$row = $result->fetch_object();   
        echo "<form action = \"updateCompetition.php\" method=\"post\" class=\"choice-bar\">";
        echo"<tr class=\"odd\">";
        echo "<td><input name=\"compID\" id=\"compID\" value=" . $row->compID . " ></input></td>"; 
        echo "<td><input name=\"compName\" id=\"compName\" value=" . $row->compName . "></input></td>";
        echo "<td><input name=\"compArr\" id=\"compArr\" value =" . $row->compArr . "></input></td>";
        echo "<td><input name=\"compDate\" id=\"compDate\" value =" . $row->compDate . "></input></td>";
        echo "<td><input name=\"compLastDate\" id=\"compLastDate\" value =" . $row->compLastDate . "></input></td>";
        echo "</table>";
        echo "<input type='submit' id='edit-button' value='Uppdatera'>";
        echo "</form>";*/
        
        
     
      
    //}
  //}
	mysqli_close($con);	
  //var_dump(compID);
?>



<script type="text/javascript">
var ID=2;
$('#createTable').change(function() {
    
		var competition =  $('#createTable').find(":selected").text();
    //var competition =  document.getElementById("createTable");
    //var competition =  'Knarklyft';
    //document.write(competition);
		$.ajax({
      
      //Skapar tabellen för tävling
			
      url: 'database/getCompetitionByName.php?competition='+competition+'',
      
     
			success: function(content){
          
        
        content = $.parseJSON(content);        
        
        var dat_string = '<table id="competitionTable">';
				dat_string += '<tr> <th>ID</th> <th>Name</th> <th>Arr</th> <th>Date</th> <th>LastDate</th></tr>';
        
        dat_string+='<tr><td>'+content.compID+'</td><td>'+content.compID+'</td><td>'+content.compArr+'</td><td>'+content.compDate+'</td><td>'+content.compLastDate+'</td></tr>' 
        
        dat_string += '</table>';
        document.getElementById('table').innerHTML = dat_string;
        
        var ID = content.compID;
        console.log(ID);
			}
      
		});
    
    $.ajax({
      /*
        Skriver ut grenar från en tävling
        */
      
      url: 'database/getAgeClassById.php?ID='+ID+'',
      
      success: function(content){
        //console.log(ID);
				//console.log('Dat shiet!');
        //console.log(content);
        content = $.parseJSON(content);
        
        console.log(content);
        
        
        var dat_string2 = '<table id="competitionTable2">';
				dat_string2 += '<tr> <th>ageclass</th> <th>discipline</th></tr>';
        
        $.each(content, function(index, value) {
        dat_string2+='<tr><td>'+value.ageC+'</td><td>'+value.disc+'</td></tr>' 
        });
        dat_string2 += '</table>';
        document.getElementById('table2').innerHTML = dat_string2;
        //document.getElementById('table2').innerHTML = "BALLE";
			}
      
		});
    
	});
  
</script>

<div id="table">Här ska skit dyka upp</div>
<div id="table2">Här ska skit dyka upp</div>

<?php
include "templates/adminfooter.php";
?>