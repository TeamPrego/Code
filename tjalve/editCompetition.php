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

  
  
  /*echo "<div  class='choice-bar'>";
  $fatSelect="<select id='dope'><option>Tävlingsnamn</option>";
  foreach ($allCompetitions as $competition) {
    $fatSelect.= "<option>" . $competition->name . "</option>";
  }
  $fatSelect.="</select>";
  echo $fatSelect;
  echo "</div>";*/
  
  
  
 
  
  /*
  $fatTable="<table class=firstTableList><th>Tävlingsid</th><th>Tävlingsnamn</th><th>Tävlingsarrangör</th><th>Tävlingsstart</th><th>Sista Anmälningsdatum</th><tr>";
  foreach ($allCompetitions as $competition) {
    $fatTable.= "<tr><td>" . $competition->id . "</td><td>" . $competition->name . "</td><td>" . $competition->organizer    . "</td><td>" . $competition->date . "</td><td>" . $competition->lastDate . "</td></tr>";
    //$fatTable.= "<tr><td>GET SWOLE</td></tr>";
    //echo $competition['name'];
  }
  $fatTable.="</tr></table>";
  echo $fatTable;*/
 
  //Here you are supposed to choose the disciplines for one or several events.
  $compDisciplines = new Competition();
  $allDisciplines = $compDisciplines->getAllAvailableDisciplines2();
  $discTable="<table class=firstTableList><th>Disciplin</th><tr>";
  //$discTable="<table class=firstTableList><th>Disciplin</th><tr>";
  foreach ($allDisciplines as $discipline) {
    //$discTable.= "<tr><td><input type='checkbox' id='discipline' name='discipline[]' value='" . $discipline['discipline'] . "'>" . $discipline['discipline'] . "</td></tr>";
    $discTable.= "<tr><td><input type='checkbox' id='discipline' name='discipline[]' value='" . $discipline['discipline'] . "'>" . $discipline['discipline'] . "</td></tr>";
  }
  $discTable.="<td><input type='button' name = 'submitDiscipline' id='addEvent' value='Lägg till Start'/></td></tr></table>";
 



?>
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
      alert(dat_string);
    }
  });
}


$(function(){
  $("#updateCompetition").live('click', function (){ 
  var id = $('#idField').val();
  var name = $('#nameField').val();
  var date = $('#dateField').val();
  var lastDate = $('#lastDateField').val();
  var organizer = $('#organizerField').val();

  
  alert("Ett gäng ambitiösa strutande strutsar");
  alert(id+" "+name+" "+date+" "+lastDate+" "+organizer+" ");
  
  $.ajax({
    async:false,
    //var name = $("#namefield").val();
    url: 'Ajax/ajax.php?updateId='+id+'&updateName='+name+'&updateDate='+date+'&updateLastDate='+lastDate+'&updateOrganizer='+organizer,
    success: function(){
      alert("yai");
      //var competition =  $("#dope").find(":selected").text();
      //$("#chooseClass option:selected").html("New Text");
      //alert($("#chooseClass").find(":selected").text());
      //$("._statusDDL").val('2');
      createSelect();
    }
  });
});
});

$(function(){
  //$( "#dope" ).change(function() {
  $( "#dope" ).live('change', function() {
   
   var competition = $('#nameField').val();
   alert(competition);
   if(competition==null){
    var competition =  $("#dope").find(":selected").text();
   }
    $.ajax({
      async: false,
      //Skapar tabellen för tävling
			
      
      url: 'Ajax/ajax.php?compName='+competition+'',

      
			dataType: 'json', 
      
      success: function(content){
        
        
        
        
        var dat_string = '<table id="competitionTable" class="firstTableList">';
				dat_string += '<tr> <th>ID</th> <th>Namn</th><th>Datum</th> <th>Sista anmälningsdatum</th> <th>Arrangör</th> </tr>';
         dat_string+='<tr><td><input type="text" id="idField" value="'+content[0].id+'" disabled /></td><td><input type="text" id="nameField" value="'+content[0].name+'"/></td><td><input type="date" id="dateField" class="input-medium search-query" value="'+content[0].date+'"/></td><td><input type="date" id="lastDateField" class="input-medium search-query" value="'+content[0].lastDate+'"/></td><td><input type="text" id="organizerField" value="'+content[0].organizer+'"/></td></tr>'
        //dat_string+='<tr><td><input type="button" id="updateCompetition" onclick="updateCompetition('+"'"+content[0].id+"'"+", '"+$("#namefield").val()+"'"+", '"+content[0].date+"'"+", '"+content[0].lastDate+"'"+", '"+content[0].organizer+"'"+')" value="Uppdatera"></td></tr>';
        dat_string+='<tr><td><input type="button" id="updateCompetition" value="Uppdatera"></td></tr>';
        dat_string += '</table>';
        
        document.getElementById('table').innerHTML = dat_string;
        
        //ID saved for adding events to database
        ID = content[0].id;
        
        var dat_string2 = '<table id="competitionTable" class="firstTableList">';
        dat_string2 += '<tr> <th>ID</th> <th>Åldersklass</th><th>Gren</th> </tr>';
        $.each(content[1], function(index, value) {
          /* dat_string2+='<tr><td>'+value.competitionId+'</td><td>'+value.yearClass+'</td><td>'+value.discipline+'</td><td><button id="mybutton" onclick="deleteEvent('+"'"+value.yearClass+"'"+", '"+value.discipline+"'"+')">Button</button></td></tr>' */
          dat_string2+='<tr><td>'+value.competitionId+'</td><td>'+value.yearClass+'</td><td>'+value.discipline+'</td><td><button id="mybutton" onclick="deleteEvent('+"'"+value.competitionId+"'"+", '"+value.yearClass+"'"+", '"+value.discipline+"'"+')">x</button></td></tr>'

        });
        dat_string2 += '</table>';
        
        message = "Clicked Button";
        
        document.getElementById('table2').innerHTML = dat_string2;
        //document.getElementById('table3').innerHTML = '<button id="mybutton" onclick="deleteEvent()">Button</button>';
 
			}  
		});
  });
 }); 
  

  
$(function(){ 
    $( "#addEvent" ).click(function() {
      alert("Nån vill lägga till event");
     //$(content).remove();
     alert("kvar efter remove");
      var checkboxes = $('input[type=checkbox]:checked');
      var chosenClass = $("#chooseClass").find(":selected").text();
      
      var boxString="";
      for (var i=0, n=checkboxes.length; i<n;i++) {
        if (checkboxes[i].checked) 
        {
          alert("Id: "+ ID +" Klass: "+chosenClass+"  Gren: "+checkboxes[i].value);
          boxString+=checkboxes[i].value+".";
        }
      }
      
      alert(ID+" "+checkboxes[0].value+" "+chosenClass);
      $.ajax({
        async: false,
        
        url: 'Ajax/ajax.php?ID='+ ID +'&disciplines='+boxString+'&chosenClass='+chosenClass,
        
        //Detta borde stämma skapligt!!!
        //Fösök att spara alla event och uppdatera tabellen. 
        //Kan hämta event och bara lägga till
        
        success: function(){
          
          $("#dope").change();
        } 
        
      });
    });
  });
  
  /*$(function(){
    
   $( "#deleteEvent" ).click(function() {
      alert("Ta bort ta bort ta bort!!!");
    });
  });*/
  function deleteEvent(id, yearClass, discipline){
    alert("Ta bort ta bort ta bort!!!");
    alert(id+" "+yearClass+" "+discipline);
    $.ajax({
      url: 'Ajax/ajax.php?deleteId='+id+'&deleteYearClass='+yearClass+'&deleteDiscipline='+discipline,
      success: function(){
      
          $("#dope").change();
      }
    });
  }
  
  
</script>
<?php
  echo $discTable;
?>









<?php
include "templates/adminfooter.php";
?>