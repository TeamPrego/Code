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

	
  echo"<div class='choice-bar'>";
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
        
        var dat_string = '<table id="competitionTable" class="firstTableList">';
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
        
        
        var dat_string2 = '<table id="competitionTable2" class="firstTableList">';
				dat_string2 += '<tr> <th>ageclass</th> <th>discipline</th></tr>';
        
        $.each(content, function(index, value) {
        dat_string2+='<tr><td>'+value.ageC+'</td><td>'+value.disc+'</td></tr>' 
        });
        dat_string2 += '</table>';
        document.getElementById('table2').innerHTML = dat_string2;
        
			}
      
		});
    
    $.ajax({
      /*
        Skriver tillgängliga grenar i en drop-list 
      */
      
      url: 'database/getAllClasses.php',
      
      success: function(content){
        
        content = $.parseJSON(content);
        
        console.log(content);
        
        
        var dat_string3 = '<select name="createTableDisc" id="createTableDisc" value="createTableDisc" onchange="createTableDisc()">';
				dat_string3 += '<option>Välj åldersklass</tr>';
        
        $.each(content, function(index, value) {
        dat_string3+='<option>'+value.class+'</option>' 
        });
        dat_string3 += '</select>';
        document.getElementById('select').innerHTML = dat_string3;
        
        
			}
      
		});
    /*
        Skriver tillgängliga grenar i en tabell 
      */
    
    
    
});
function createTableDisc(){
  $.ajax({
      
      
      url: 'database/getAllDisciplines2.php',
      
      success: function(content){
        
        content = $.parseJSON(content);
        
        
        var dat_string4 = '<table id="disciplines" class="firstTableList">';
        dat_string4 += '<tr></tr>';
        $.each(content, function(index, value) {
        dat_string4+='<tr><td><input type="checkbox">'+value.gren+'</td></tr>' 
        });
        dat_string4 += '</table>';
        //dat_string4+='<input type="button" class="result-button">';
       
        document.getElementById('table3').innerHTML = dat_string4;
        
			}
      
		});
}
 /* 
$('#createTableDisc').change(function() {
    
		//document.write("DUDE!");
    
    $.ajax({
      
      //console.log("Zup Brah!");
      url: 'database/getAllDisciplines.php',
      
      success: function(content){
        //console.log("Zup Brah!");
        content = $.parseJSON(content);
        
        console.log(content);
        
        
        var dat_string4 = '<table id="disciplines">';
        dat_string4 += '<tr> <th></th></tr>';
        $.each(content, function(index, value) {
        dat_string4+='<tr><td>'+value.gren+'</td></tr>' 
        });
        dat_string4 += '</table>';
        document.getElementById('table3').innerHTML = dat_string4;
        
			}
      
		});
});
 */ 
</script>
<table>
<td id="table">Här ska skit dyka upp</td>
<td id="table2">Här ska skit dyka upp</td>
<td>
<td id="select">Här ska skit dyka upp</td>
</td>
<td id="table3">
Här ska skit dyka upp
</td>
</table>
<?php
include "templates/adminfooter.php";
?>