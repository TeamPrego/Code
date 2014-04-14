<?php
include "templates/adminheader.php";
?>

<!--
Just nu testas koden mot competition-klassen. 
Tanken är att man ska kunna skapa ett objekt som man arbetar med. 
Initialt skapas ett objekt genom getCompetition där man skickar in bara namnet. 
-->




<?php
  
  include "class/competition.php";
  $comp = new Competition();
  //$comp->getCompetitionByName("Flonk Close");
  
  $allCompetitions = $comp->getAllCompetitions();
  
  //print_r($allCompetitions);
  echo "<div  class='choice-bar'>";
  $fatSelect="<select id='dope'><option>Tävlingsnamn</option>";
  foreach ($allCompetitions as $competition) {
    $fatSelect.= "<option>" . $competition['name'] . "</option>";
  }
  $fatSelect.="</select>";
  echo $fatSelect;
  echo "</div>";
  
  
  
 
  
  
  $fatTable="<table class=firstTableList><th>Tävlingsid</th><th>Tävlingsnamn</th><th>Tävlingsarrangör</th><th>Tävlingsstart</th><th>Sista Anmälningsdatum</th><tr>";
  foreach ($allCompetitions as $competition) {
    $fatTable.= "<tr><td>" . $competition['id'] . "</td><td>" . $competition['name'] . "</td><td>" . $competition['arranger'] . "</td><td>" . $competition['beginDate'] . "</td><td>" . $competition['lastDate'] . "</td></tr>";
    //$fatTable.= "<tr><td>GET SWOLE</td></tr>";
    //echo $competition['name'];
  }
  $fatTable.="</tr></table>";
  echo $fatTable;
 
  $compDisciplines = new Competition();
  $allDisciplines = $compDisciplines->getAllAvailableDisciplines();
  $discTable="<table class=firstTableList><th>Disciplin</th><tr>";
  foreach ($allDisciplines as $discipline) {
    $discTable.= "<tr><td><input type='checkbox'>" . $discipline['discipline'] . "</td></tr>";
  }
  $discTable.="</tr></table>";
  //echo $discTable;
  
 
  //include "class/competition.php";
  //$comp1 = new Competition();
  //$comp1->getAllYearClasses();
  

  

 

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
  //echo $comp->name;
  //echo $comp->id;
  //createTable($comp->id, $comp->name, $comp->beginDate, $comp->lastDate, $comp->arranger)
  //echo "<input type='button' onclick='" . createTable($comp->id, $comp->name, $comp->beginDate, $comp->lastDate, $comp->arranger) . "' value='Funka!!!'>";
    
  /* function createTable($id, $namn, $begin, $last, $arr){
    echo "<table class='firstTableList'><tr><td>" . $id . "</td><td>" . $namn . "</td><td>" . $begin . "</td><td>" . $last . "</td><td>" . $arr . "</td></tr></table>";
  } */
  //function doShit(){echo "alert('shit')";}

/*
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
  
	mysqli_close($con);	*/
?>
<table class ="createcompTable">
	
      <td>Åldersklass:</td>
	  
      <td colspan="2"> 
		  <select name="chooseClass" id="chooseClass" required>
					<option> - Välj klass - </option>
		 
						<?php
						$allyearclasses = new competition();
						$allyearclasses->getAllYearClasses();
						?>
			</select>
		  </td>
        </td>
	 </tr>	 
</table>


<script type="text/javascript">
  $( "#dope" ).change(function() {
    var competition =  $("#dope").find(":selected").text();
    //var competition = "TFC";
    //alert("Hallå");
    $.ajax({
      //async: false,
      //Skapar tabellen för tävling
			
      url: 'class/competition.php?compName='+competition+'',
      //url: 'class/competition.php',

      //data: 'TFC',

			dataType: 'json', 
      
      success: function(content){
        
        //console.log("Yao!");
        //console.log(data);
      
        console.log("Tja Bre");
            
        //content = $.parseJSON(content); 
        console.log(content); 
        
        //console.log("Fuck you!");  
        
        var dat_string = '<table id="competitionTable" class="firstTableList">';
				dat_string += '<tr> <th>ID</th> <th>Name</th><th>Date</th> <th>LastDate</th> <th>Arr</th> </tr>';
        dat_string+='<tr><td>'+content.competitionId+'</td><td>'+content.competitionName+'</td><td>'+content.date+'</td><td>'+content.lastDate+'</td><td>'+content.organizer+'</td></tr>' 
        
        dat_string += '</table>';
        console.log(dat_string);
        document.getElementById('table').innerHTML = dat_string;
        
        
       
			}
      //document.getElementById('table').innerHTML = "Get Swole";
		});
    //document.getElementById('table').innerHTML = "Get Swole";
    //alert(competition);
    alert("Kalla då");
    //showAgeClasses();
  });
  
  /*$( "#chooseClass" ).change(function() {
    var chosenClass= $("#chooseClass").find(":selected").text();
    alert("Det är ingen hemma "+chosenClass );
    dat_string3='<table class="firstTableList">';
      dat_string3+='<tr><th>Grenar</th></tr><tr>';
        //dat_string3+='<td>';
        //dat_string3+=rave;
        //dat_string+='</td>';
        <?php 
          $allEvents = new Competition();
          $allEvents->getAllCompetitions();
        ?>
      dat_string3+='</tr>';
    dat_string3+='</table>';
    document.getElementById('table3').innerHTML=dat_string3;
  });*/
  
  /*$( "#showAgeClasses" )(function() {
  //alert("Zup brah");
  dat_string2='<table class ="createcompTable"><td>Åldersklass:</td><td colspan="2">'; 
        dat_string2+='<select name="chooseClass" id="chooseClass" required>';
            dat_string2+='<option> - Välj klass - </option>';
       
              <?php
              $allyearclasses = new competition();
              $allyearclasses->getAllYearClasses();
              ?>
        dat_string2+='</select>';
        dat_string2+='</td></td></tr></table>';
    document.getElementById('table2').innerHTML=dat_string2;
  //});*/
  
</script>
<?php
  echo $discTable;
?>


<!--
<script type="text/javascript">
//var ID=0;
$('#createTable').change(function() {
    
		var competition =  $('#createTable').find(":selected").text();
    document.getElementById('table3').style.display = 'none';
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
        dat_string4+='<input type="button" class="result-button" value="Lägg till grenar!!!">';
       
        document.getElementById('table3').innerHTML = dat_string4;
        document.getElementById('table3').style.display = 'block';
        
			}
      
		});
}

</script>
-->




<table id="innerBody">
  <td id="leftPartOfApplication">
    <td id="table">Här ska skit dyka upp</td>
    <td id="table2">Här ska skit dyka upp</td>
  </td>
  <td id="rightPartOfApplication">
    <td id="select">Här ska skit dyka upp</td>
    <td id="table3">
      Här ska skit dyka upp
    </td>
  </td>
</table>

<?php
include "templates/adminfooter.php";
?>