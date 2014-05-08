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
  $participants = array();
  foreach ($allparticipants as $participant) {
    $temp = new Participant();
    $participant2 = $temp->getParticipantById($participant['participantId']);
    //Nedan skrivs tabellen för deltagarna ut.
    //Den innehåller fält för längd vind och knappar för underkänt och pass
    
    foreach($participant2 as $p){
    //echo $counter;
      $name = $p['firstName'] . $p['lastName'];
      $participants[] = $name;
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
      
      /*$finalTable .= "<tr><td>" . $p['firstName'] . " " . $p['lastName'] . "<td>
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
      </tr>";*/
    }
    $counter = $counter+1;
  }
  //$qualTable .= "<td><input type='button' id='reportQual' value='Rapportera Kvalresultat' /></td>";
  $qualTable .= "</table>";
  //$finalTable .= "<td><input type='button' id='reportFinal' value='Rapportera Finalresultat' /></td>";
  //$finalTable .= "</table>";
  
  echo "<h2>KVAAAAAAAL</h2>";
  echo $qualTable;
  echo "<td><input type='button' id='reportQual' class='result-btn' value='Rapportera Kvalresultat' /></td>";
  //echo "<h2>FINAAAAAL</h2>";
  //echo $finalTable;
  //echo "<td><input type='button' id='reportFinal' class='result-btn' value='Rapportera Finalresultat' /></td>";
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
      
      var flonk = <?php echo json_encode($participants); ?>;
      var array = [];
      //array[flonk[0]] = [];
      var i=0; 
      while(flonk[i]){
        //alert(flonk[i]);
        //alert("Tjo bre");
        array[i] = [];
        array[i][0] = $("#"+flonk[i] +"firstTry").val();
        array[i][1] = $("#"+flonk[i] +"secondTry").val();
        array[i][2] = $("#"+flonk[i] +"thirdTry").val();
        i++;
      }
      
      
      
      
      var k = 0; 
      while(flonk[k]){
        array[k].sort(compareInts);
        array[k].reverse();
        //alert(flonk[k]+": "+array[k][0]+" "+array[k][1]+" "+array[k][2]);
        k++;
      }
      
      var l=0;
      
      var temp = [];
      var temp2 = [];
      var upperLimit = flonk.length;
      alert("Upper limit "+upperLimit+"array 0 "+array[0]);
      while(upperLimit > 0){
        while((l+1)<upperLimit){
        
          alert(array[l][0]);
          if(compareInts(array[l][0], array[l+1][0]) < 0){
            alert("byt plats på "+flonk[l]+": "+array[l]+" & "+flonk[l+1]+": "+array[l+1]);
            temp = flonk[l];
            flonk[l] = flonk[l+1];
            flonk[l+1]=temp;
            temp2 = array[l];
            array[l] = array[l+1];
            array[l+1] = temp2;
          }else if(compareInts(array[l][0], array[l+1][0]) == 0){
            if(compareInts(array[l][1], array[l+1][1]) < 0){
            alert("byt plats på "+array[l]+" & "+array[l+1]);
            temp = flonk[l];
            flonk[l] = flonk[l+1];
            flonk[l+1]=temp;
            temp2 = array[l];
            array[l] = array[l+1];
            array[l+1] = temp2;
            }else if(compareInts(array[l][1], array[l+1][1]) == 0){
              if(compareInts(array[l][2], array[l+1][2]) < 0){
              alert("byt plats på "+array[l]+" & "+array[l+1]);
              temp = flonk[l];
              flonk[l] = flonk[l+1];
              flonk[l+1]=temp;
              temp2 = array[l];
              array[l] = array[l+1];
              array[l+1] = temp2;
            }
          }
          }
          l++;
        }
        l=0;
        upperLimit--;
      }
      var p=0;
      while(flonk[p]){
        alert(flonk[p]+" resultat "+array[p]);
        //alert("Tjo bre");
        //alert(array[p]);
        p++;
      }
      
      //alert(array[flonk[0]][2]);
        //Spara alla deltagare i en array så har du namnen att söka på
        //Använd dessa för att checka värden i fieldsen och spara jämför dessa mot varandra
        //använd javascripts sort för att sortera arrayer och jämför sedan element för element
      
    });
    function compareInts(a,b) { 
      return a-b; 
    }
  </script>
      
  
      
    
  

<?php
  include "templates/adminfooter.php"
?>