<?php

 include "templates/adminheader.php";
include "class/competition.php";
?>	

<!--Header for the page--> 
<h1>
  Skapa startlista
</h1>   
<div id = "compList">
   <table id ="selectedDisciplines">
	<form id="secForm" name="secForm" method="post" enctype="multipart/form-data" action="createStartList.php">
		<tr>
			<td>Välj tävling:</td>
		</tr>
		
		<tr>
			<td>
      <?php
          $allcomp = new competition();
          $array[]=$allcomp->getAllCompetitions();
          
          foreach($array as $value){
         // echo'<pre>'; print_r($value); echo '<pre/>';
            foreach($value as $key){
            //sortera i omvänd ordning???
            //fixa css för knapparna...
              printf("\t<tr><td>%s</td><td><input type='submit' name=".$key->id." value='Välj!!!!!!!!!'></td></tr>\n", $key->name, $key->id);
              if(isset($_POST[$key->id])){
                header("Location: createStartListStep2.php?compID=".$key->id);
              }
            }
          }
        ?>
        </td>
		</tr>
	</form>
</table>
</div>





<!--varför funkar inte cookie så den inte har ett värde från början och varför uppdateras den inte ??

    ta fram participantdisciplines så man kan lotta en startlista, ska man kunna väla gren och åldersklass i två olika dropdownlister 
    så man lottar en gren/åldersklass i tagen ??? hur tycker gruppen.....-->


<?php
	// Add footer for the user-pages
	include "templates/footer.php";
?>