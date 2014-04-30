<?php
include "templates/adminheader.php";
?>

<!--
The file represent the edit competition page. The user is able to load a competition and then 
change said competition. The code is organized with ajax calls to ajax.php and from that file to 
competition- and event-class. 
-->

<?php
  
  include "class/competition.php";
  $comp = new Competition();  
  $allCompetitions = $comp->getAllCompetitions();


  
  
 
  
  
 

 
  /* Here you are supposed to choose the disciplines for one or several events.
  The disciplines are loaded into a table with checkboxes. This table is supposed to be used
  together with chooseClass drop-list to add events to the competition.
  */
  $compDisciplines = new Competition();
  $allDisciplines = $compDisciplines->getAllAvailableDisciplines2();
  $discTable="<table class=firstTableList><th>Disciplin</th><tr>";
  foreach ($allDisciplines as $discipline) {
    $discTable.= "<tr><td><input type='checkbox' id='discipline' name='discipline[]' value='" . $discipline['discipline'] . "'>" . $discipline['discipline'] . "</td></tr>";
  }
  $discTable.="<td><input type='button' name = 'submitDiscipline' id='addEvent' value='Lägg till Start'/></td></tr></table>";
 



?>

<!--
Tables are created for showing content on the page. 
-->

<table>
<td id="rightPartOfApplication">
    <td id="table3"> Här ska skit dyka upp</td>
</td>
</table>
<table id="innerBody">
  <td id="leftPartOfApplication">
    <td id="table">Här ska skit dyka upp</td>
  </td>
  <td id="rightPartOfApplication">
    <td id="table2"> Här ska skit dyka upp</td>
  </td>
  
</table>

<!--
This is the table which displays the general info about 
the chosen competition. Namely competition name, date and last date for applying.
-->

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
var ID;
createSelect();

/*
Function below is for creating a drop list for selecting 
competition. Generic is sent to ajax as a string but is never used.  
*/


function createSelect(){
  $.ajax({
    url: 'Ajax/ajax.php?getAllCompetitions=generic',
    
    success: function(content){
      
      dat_string = "<select id='dope'><option>Tävlingsnamn</option>";
      
      dataType: 'json',
      content = JSON.parse(content);
      $.each(content, function(index, value) {
          
          dat_string+='<option>'+value.name+'</option>'
          console.log(value.name);
      });
      dat_string+="</select>";
      document.getElementById('table3').innerHTML = dat_string;
    }
  });
}

/*
Information about the  competition is update thwough the table
generated when loading competition data.
*/
$(function(){
  $("#updateCompetition").live('click', function (){ 
  var id = $('#idField').val();
  var name = $('#nameField').val();
  var date = $('#dateField').val();
  var lastDate = $('#lastDateField').val();
  var organizer = $('#organizerField').val();
  
  $.ajax({
    async:false,
    url: 'Ajax/ajax.php?updateId='+id+'&updateName='+name+'&updateDate='+date+'&updateLastDate='+lastDate+'&updateOrganizer='+organizer,
    success: function(){
      createSelect();
    }
  });
});
});
/*
Function is used to collect data when changing competition to display. 
Since the information about the competition is supposed to be updated this 
function is used to send the correct name from the drop-list.
*/
$( "#dope" ).live('change', function() {
  var competition =  $("#dope").find(":selected").text();
  updateTables(competition);
});

/*
Function updates the displayed tables.
Requires the name of the competition.
*/
   function updateTables(competition){
    alert("Uppdatera dumfan: "+competition);
    $.ajax({
      
      async: false,
      url: 'Ajax/ajax.php?compName='+competition+'',
			//url: 'Ajax/ajax.php?updateId=1 &updateName=BronkSpelarna dateDate=2014-05-01 &updateLastDate=2014-04-30 &updateOrganizer=Jag',
      dataType: 'json', 
      
      success: function(content){
        
        console.log("Stronk");
        alert("success");
        
        var dat_string = '<table id="competitionTable" class="firstTableList">';
				dat_string += '<tr> <th>ID</th> <th>Namn</th><th>Datum</th> <th>Sista anmälningsdatum</th> <th>Arrangör</th> </tr>';
        dat_string+='<tr><td><input type="text" id="idField" value="'+content[0].id+'" disabled /></td><td><input type="text" id="nameField" value="'+content[0].name+'"/></td><td><input type="date" id="dateField" class="input-medium search-query" value="'+content[0].date+'"/></td><td><input type="date" id="lastDateField" class="input-medium search-query" value="'+content[0].lastDate+'"/></td><td><input type="text" id="organizerField" value="'+content[0].organizer+'"/></td></tr>';
        dat_string+='<tr><td><input type="button" id="updateCompetition" value="Uppdatera"></td></tr>';
        dat_string += '</table>';
        
        document.getElementById('table').innerHTML = dat_string;
        
        ID = content[0].id;
        
        var dat_string2 = '<table id="competitionTable" class="firstTableList">';
        dat_string2 += '<tr> <th>ID</th> <th>Åldersklass</th><th>Gren</th> </tr>';
        $.each(content[1], function(index, value) {
          dat_string2+='<tr><td>'+value.competitionId+'</td><td>'+value.yearClass+'</td><td>'+value.discipline+'</td><td><button id="mybutton" onclick="deleteEvent('+"'"+value.competitionId+"'"+", '"+value.yearClass+"'"+", '"+value.discipline+"'"+')">x</button></td></tr>'

        });
        dat_string2 += '</table>';
        
        message = "Clicked Button";
        
        document.getElementById('table2').innerHTML = dat_string2;
 
			}  
		});
  }

  

/*
Function adds event to competition. 
Saves the chose disciplines from the checked checkboxes.
Also saves the chosen class. These are sent through ajax to the event class to insert the events.
*/  
$(function(){ 
    $( "#addEvent" ).click(function() {
      var checkboxes = $('input[type=checkbox]:checked');
      var chosenClass = $("#chooseClass").find(":selected").text();
      
      var boxString="";
      for (var i=0, n=checkboxes.length; i<n;i++) {
        if (checkboxes[i].checked) 
        {
          boxString+=checkboxes[i].value+".";
        }
      }
      $.ajax({
        async: false,
        
        url: 'Ajax/ajax.php?ID='+ ID +'&disciplines='+boxString+'&chosenClass='+chosenClass,
        
        success: function(){
          
          var name = $('#nameField').val();
          updateTables(name);
        } 
        
      });
    });
  });
  
  /*
  The user deletes an event with the cross-button displayed next to the event.
  The name of the competition is used when updating the page.
  */
  function deleteEvent(id, yearClass, discipline){
    $.ajax({
      url: 'Ajax/ajax.php?deleteId='+id+'&deleteYearClass='+yearClass+'&deleteDiscipline='+discipline,
      success: function(){

          var name = $('#nameField').val();
          updateTables(name);
      }
    });
  }
  
  
</script>

<!--
The table of disciplines is displayed at the bottom of the page.
-->

<?php
  echo $discTable;
?>









<?php
include "templates/adminfooter.php";
?>