<?php
  include "templates/adminheader.php";
  include_once "../class/Event.php";
  include_once "../class/Participant.php";
?>
  
<?php
  //Här ska skickas in eventid från en annan sida genom exempelvis url:en
  $eventId = "2";
  $event = new Event();
  $result = $event -> getSingleEventById($eventId);
  $eventTitle = $result->ageClass . " ";
  $eventTitle .= $result->discipline;
  
  echo "<h1>" . $eventTitle . "</h1>";
  
  
  $participant = new Participant();
  $allparticipants = $participant->getParticipantsByEventId($eventId);
  
  //Visar en tabell med deltagare för att man ska kunna fylla i deras resultat
  //hämta först alla deltagare till ett visst event och hämta sedan namn och klubbinfo för dessa deltagare
  
  $qualTable = "<table class='firstTableList'><th>Namn</th><th>Försök 1</th><th>Försök 2</th><th>Försök 3</th>";
  $finalTable = "<table class='firstTableList'><th>Namn</th><th>Försök 4</th><th>Försök 5</th><th>Försök 6</th><tr></tr>";
  $counter = 1;
  foreach ($allparticipants as $participant) {
    $temp = new Participant();
    $participant2 = $temp->getParticipantById($participant['participantId']);
    
    //Nedan skrivs tabellen för deltagarna ut.
    //Den innehåller fält för längd vind och knappar för underkänt och pass
    
    foreach($participant2 as $p){
    //echo $counter;
      $name = $p['firstName'];
      $qualTable .= "<tr><td>" . $p['firstName'] . " " . $p['lastName'] . "</td>
      
      <td>
        <input type ='text'  id='" . $name . "firstTry' placeholder='Längd' class='vert-field'/>"
        ."<input type ='text'  id='" . $name . "firstWind' placeholder='Vind' class='vert-field'/>"
        ."<input type = 'button' class='fail-btn' id='". $name . "first' value='x'/>"
        ."<input type = 'button' class='pass-btn' id='" . $name . "first' value='-'/>
      </td>
      <td>
        <input type ='text' id='" . $name . "secondTry' placeholder='Längd' class='vert-field'/>"
        ."<input type ='text'  id='" . $name . "secondWind' placeholder='Vind' class='vert-field'/>"
        ."<input type = 'button' class='fail-btn' id='" . $name . "second' value='x'/>"
        ."<input type = 'button' class='pass-btn' id='" . $name . "second' value='-'/>
      </td>
      <td>
        <input type ='text' id='" . $name . "thirdTry' placeholder='Längd' class='vert-field'/>"
        ."<input type ='text'  id='" . $name . "thirdWind' placeholder='Vind' class='vert-field' />"
        ."<input type = 'button' class='fail-btn' id='" . $name . "third' value='x'/>"
        ."<input type = 'button' class='pass-btn' id='" . $name . "third' value='-'/>
      </td>";
      
      $finalTable .= "<tr><td>" . $p['firstName'] . " " . $p['lastName'] . "<td>
        <input type ='text' id='" . $name . "fourthTry' disabled placeholder='Längd' class='vert-field'/>"
        ."<input type ='text'  id='" . $name . "fourthWind' placeholder='Vind' class='vert-field' disabled/>"
        ."<input type = 'button' class='fail-btn' id='" . $name . "fourth' value='x' disabled/>"
        ."<input type = 'button' class='pass-btn' id='" . $name . "fourth' value='-' disabled/>
      </td>
      <td>
        <input type ='text' id='" . $name . "fifthTry' disabled placeholder='Längd' class='vert-field'/>"
        ."<input type ='text'  id='" . $name . "fifthWind' placeholder='Vind' class='vert-field' disabled/>"
        ."<input type = 'button' class='fail-btn' id='" . $name . "fifth' value='x' disabled/>"
        ."<input type = 'button' class='pass-btn' id='" . $name . "fifth' value='-' disabled/>
      </td>
      <td>
        <input type ='text' id='" . $name . "sixthTry' disabled placeholder='Längd' class='vert-field'/>"
        ."<input type ='text'  id='" . $name . "sixthWind' placeholder='Vind' class='vert-field' disabled/>"
        ."<input type = 'button' class='fail-btn' id='" . $name . "sixth' value='x' disabled/>"
        ."<input type = 'button' class='pass-btn' id='" . $name . "sixth' value='-' disabled/>
      </td>
      </tr>";
    }
    $counter = $counter+1;
  }
  //$qualTable .= "<td><input type='button' id='reportQual' value='Rapportera Kvalresultat' /></td>";
  $qualTable .= "</table>";
  //$finalTable .= "<td><input type='button' id='reportFinal' value='Rapportera Finalresultat' /></td>";
  $finalTable .= "</table>";
  
  echo "<h2>KVAAAAAAAL</h2>";
  echo $qualTable;
  echo "<td><input type='button' id='reportQual' value='Rapportera Kvalresultat' /></td>";
  echo "<h2>FINAAAAAL</h2>";
  echo $finalTable;
  echo "<td><input type='button' id='reportFinal' align='center' value='Rapportera Finalresultat' /></td>";
?>
  
  <!--
    Nedan funktioner för underkänt- och passknapparna
    Först tar man redan på vilket textfält knappen tillhör och sedan ändras fältets värde/text
  -->
  <script>
    $(".fail-btn").click('button',function(){
      var field = $(this).attr('id');
      $( "#"+field+"Try" ).val("x")
      $( "#"+field+"Wind" ).val("x")
    });
    
    $(".pass-btn").click('button',function(){
      var field = $(this).attr('id');
      $( "#"+field +"Try" ).val("-")
      $( "#"+field +"Wind" ).val("-")
    });
    
    $("#reportQual").click('button',function(){
      alert("RAPPORTERA BRE!");
      
    });
  </script>
      
  
      
    
  

<?php
  include "templates/adminfooter.php"
?>